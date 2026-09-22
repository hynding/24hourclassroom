<?php

use App\Ai\Exceptions\AnthropicRejected;
use App\Ai\Exceptions\AnthropicUnavailable;
use App\Ai\FakeAnthropicGateway;
use App\Ai\GenerationAdvancer;
use App\Enums\GenerationStatus;
use App\Enums\QuestionType;
use App\Enums\Visibility;
use App\Models\Generation;
use App\Models\Test;
use App\Support\FrontendRedirect;
use App\Support\GenerationMessages;
use Illuminate\Support\Facades\Cache;

beforeEach(function () {
    // Sanctum's stateful-frontend check (contract ground rules).
    $this->withHeader('Referer', 'http://localhost:3333');
    // Safety net: no case in this file may reach the real gateway, even if it
    // forgets to take its own handle.
    fakeAnthropic();
});

/**
 * Queue events for the generation's session and poll as the owner. The endpoint
 * IS the advance in this codebase (spec decision 7 -- there is no queue worker
 * on the shared host), so every feature case drives the advancer through
 * GET /api/generations/{id}. Only a case that must bypass HTTP -- the held-lock
 * case, where the controller would serve the payload either way -- calls
 * app(GenerationAdvancer::class)->advance() directly.
 */
function advanceEvents(FakeAnthropicGateway $fake, Generation $g, array $events): void
{
    $fake->queueEvents($g->session_id, $events);

    test()->actingAs($g->user)->getJson("/api/generations/{$g->id}")->assertOk();
}

test('a queued generation with no session fails on the first poll', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->queued()->create();
    $this->actingAs($owner);

    $this->getJson("/api/generations/{$generation->id}")->assertOk()
        ->assertJsonPath('status', 'failed')
        ->assertJsonPath('error', GenerationMessages::NEVER_STARTED);

    $generation->refresh();
    expect($generation->status)->toBe(GenerationStatus::Failed)
        ->and($generation->finished_at)->not->toBeNull()
        // The create request died before createSession, so there is no session
        // and no uploaded file to ask Anthropic about.
        ->and($fake->calls)->toBe([]);
});

test('a run older than the cap is cancelled and torn down', function () {
    $fake = fakeAnthropic();
    $fake->returnsSessionCost(120);
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create([
        'session_id' => 'sesn_stale',
        'started_at' => now()->subMinutes((int) config('generation.max_run_minutes') + 1),
        'file_ids' => ['file_1'],
    ]);
    $this->actingAs($owner);

    $this->getJson("/api/generations/{$generation->id}")->assertOk()
        ->assertJsonPath('status', 'cancelled')
        ->assertJsonPath('error', GenerationMessages::TIMED_OUT);

    $generation->refresh();
    expect($generation->status)->toBe(GenerationStatus::Cancelled)
        ->and($generation->finished_at)->not->toBeNull()
        ->and($generation->list_cost_cents)->toBe(120)
        ->and($fake->calls)->toHaveKey('interrupt')
        ->and($fake->calls)->toHaveKey('archiveSession')
        ->and(array_map(fn ($args) => $args[1], $fake->calls['deleteFile']))->toBe(['file_1'])
        // The point of the cap is to stop paying for the session, so the poll
        // never even reads its events.
        ->and($fake->calls)->not->toHaveKey('listEvents');
});

test('a running generation whose owner removed the key is cancelled locally', function () {
    $fake = fakeAnthropic();
    // No integration row at all, so hasKey() is false -- the state the DELETE's
    // own cancel pass leaves behind if it misses a row.
    $owner = aTeacher();
    $generation = Generation::factory()->for($owner)->create(['session_id' => 'sesn_nokey']);
    $this->actingAs($owner);

    $this->getJson("/api/generations/{$generation->id}")->assertOk()
        ->assertJsonPath('status', 'cancelled')
        ->assertJsonPath('error', GenerationMessages::KEY_REMOVED);

    expect($generation->fresh()->status)->toBe(GenerationStatus::Cancelled)
        // Without a key there is nothing we may say to Anthropic on the
        // teacher's behalf: the teardown is local only.
        ->and($fake->calls)->toBe([]);
});

test('a terminal generation is returned without touching Anthropic', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->failed()->create(['error' => 'Earlier failure.']);
    $this->actingAs($owner);

    $this->getJson("/api/generations/{$generation->id}")->assertOk()
        ->assertJsonPath('status', 'failed')
        ->assertJsonPath('error', 'Earlier failure.');

    expect($fake->calls)->not->toHaveKey('listEvents')
        ->and($generation->fresh()->error)->toBe('Earlier failure.');
});

test('a poll that cannot take the generation lock does nothing', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create(['session_id' => 'sesn_locked']);
    $fake->queueEvents('sesn_locked', [
        ['id' => 'sevt_1', 'type' => 'agent.message', 'content' => [['type' => 'text', 'text' => 'Working.']]],
    ]);

    // Held by the test rather than by another poll, which is the same thing as
    // far as advance() can tell: it must be non-blocking and leave the row
    // exactly as it found it (spec decision 13).
    $lock = Cache::lock($generation->lockKey(), 180);
    expect($lock->get())->toBeTrue();

    try {
        app(GenerationAdvancer::class)->advance($generation);
    } finally {
        $lock->release();
    }

    expect($fake->calls)->not->toHaveKey('listEvents')
        ->and($generation->fresh()->agent_note)->toBeNull()
        ->and($generation->fresh()->status)->toBe(GenerationStatus::Running);
});

test('an agent message becomes the note and the latest one wins', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create(['session_id' => 'sesn_notes']);

    advanceEvents($fake, $generation, [
        ['id' => 'sevt_1', 'type' => 'agent.message', 'content' => [['type' => 'text', 'text' => 'Reading the material.']]],
        ['id' => 'sevt_2', 'type' => 'agent.message', 'content' => [['type' => 'text', 'text' => 'Drafting ten questions.']]],
    ]);

    $generation->refresh();
    // Only the newest note is kept: the SPA shows one line, not a transcript.
    expect($generation->agent_note)->toBe('Drafting ten questions.')
        ->and($generation->last_event_id)->toBe('sevt_2')
        ->and($generation->status)->toBe(GenerationStatus::Running);
});

test('a second poll over the same events processes nothing twice', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create(['session_id' => 'sesn_twice']);

    advanceEvents($fake, $generation, [
        ['id' => 'sevt_1', 'type' => 'agent.message', 'content' => [['type' => 'text', 'text' => 'First pass.']]],
        ['id' => 'sevt_2', 'type' => 'session.status_idle', 'stop_reason' => ['type' => 'requires_action']],
    ]);

    // queueEvents is cumulative and listEvents returns the whole session every
    // time, exactly like the real endpoint: the marker is what stops the second
    // poll from replaying the first two events.
    $this->actingAs($owner)->getJson("/api/generations/{$generation->id}")->assertOk()
        ->assertJsonPath('status', 'running');

    $generation->refresh();
    expect($generation->agent_note)->toBe('First pass.')
        ->and($generation->last_event_id)->toBe('sevt_2')
        ->and($generation->status)->toBe(GenerationStatus::Running)
        ->and($generation->finished_at)->toBeNull()
        ->and($fake->calls['listEvents'])->toHaveCount(2);
});

test('an event with an empty id never becomes the marker', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create(['session_id' => 'sesn_empty']);

    advanceEvents($fake, $generation, [
        // An echoed user.interrupt carries no persisted id. Storing '' as the
        // marker would make the next poll replay the whole session.
        ['id' => '', 'type' => 'user.interrupt'],
        ['id' => 'sevt_9', 'type' => 'agent.message', 'content' => [['type' => 'text', 'text' => 'Back to work.']]],
    ]);

    $generation->refresh();
    expect($generation->last_event_id)->toBe('sevt_9')
        ->and($generation->agent_note)->toBe('Back to work.');
});

test('an end_turn idle with no draft fails and tears the session down', function () {
    $fake = fakeAnthropic();
    $fake->returnsSessionCost(55);
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create([
        'session_id' => 'sesn_endturn',
        'file_ids' => ['file_7'],
    ]);

    advanceEvents($fake, $generation, [
        ['id' => 'sevt_1', 'type' => 'session.status_idle', 'stop_reason' => ['type' => 'end_turn']],
    ]);

    $generation->refresh();
    // A run that finishes without calling the tool is a failure, not a partial
    // result (spec ruling 6).
    expect($generation->status)->toBe(GenerationStatus::Failed)
        ->and($generation->error)->toBe(GenerationMessages::NO_DRAFT)
        ->and($generation->finished_at)->not->toBeNull()
        ->and($generation->list_cost_cents)->toBe(55)
        ->and($fake->calls)->toHaveKey('interrupt')
        ->and($fake->calls)->toHaveKey('archiveSession')
        ->and(array_map(fn ($args) => $args[1], $fake->calls['deleteFile']))->toBe(['file_7']);
});

test('a budget_reached idle is terminal and quotes the configured budget', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create(['session_id' => 'sesn_budget']);

    advanceEvents($fake, $generation, [
        ['id' => 'sevt_1', 'type' => 'session.status_idle', 'stop_reason' => ['type' => 'budget_reached']],
    ]);

    $generation->refresh();
    // budget_reached is terminal for us -- we never raise a cap (decision 8).
    expect(config('generation.budget_cents'))->toBe(200)
        ->and($generation->status)->toBe(GenerationStatus::BudgetReached)
        ->and($generation->error)->toBe('Stopped at the $2.00 budget before a draft was saved.')
        ->and($generation->error)->toBe(GenerationMessages::budget())
        ->and($fake->calls)->toHaveKey('archiveSession');
});

test('a retries_exhausted idle fails with the reason', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create(['session_id' => 'sesn_retries']);

    advanceEvents($fake, $generation, [
        ['id' => 'sevt_1', 'type' => 'session.status_idle', 'stop_reason' => ['type' => 'retries_exhausted']],
    ]);

    $generation->refresh();
    expect($generation->status)->toBe(GenerationStatus::Failed)
        ->and($generation->error)->toBe('Anthropic stopped the session: retries_exhausted')
        ->and($generation->finished_at)->not->toBeNull();
});

test('an idle reason this code has never heard of still fails the run', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create(['session_id' => 'sesn_unknown']);

    advanceEvents($fake, $generation, [
        ['id' => 'sevt_1', 'type' => 'session.status_idle', 'stop_reason' => ['type' => 'something_new']],
    ]);

    $generation->refresh();
    // Allowlist, not denylist: a row must never stay `running` on an idle
    // session just because Anthropic added a stop reason.
    expect($generation->status)->toBe(GenerationStatus::Failed)
        ->and($generation->error)->toBe('Anthropic stopped the session: something_new');
});

test('a session error fails the run with the platform message', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create(['session_id' => 'sesn_error']);

    advanceEvents($fake, $generation, [
        ['id' => 'sevt_1', 'type' => 'session.error', 'error' => ['message' => 'The environment could not start.']],
    ]);

    $generation->refresh();
    expect($generation->status)->toBe(GenerationStatus::Failed)
        ->and($generation->error)->toBe('The environment could not start.')
        ->and($fake->calls)->toHaveKey('archiveSession');
});

test('a terminated session fails the run', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create(['session_id' => 'sesn_term']);

    advanceEvents($fake, $generation, [
        ['id' => 'sevt_1', 'type' => 'session.status_terminated'],
    ]);

    $generation->refresh();
    expect($generation->status)->toBe(GenerationStatus::Failed)
        ->and($generation->error)->toBe(GenerationMessages::SESSION_ENDED);
});

test('an unreachable Anthropic during phase 1 leaves the row untouched', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create([
        'session_id' => 'sesn_down',
        'agent_note' => 'Earlier note.',
        'last_event_id' => 'sevt_0',
    ]);
    $fake->failNext('listEvents', new AnthropicUnavailable('connection timed out', 503));
    $this->actingAs($owner);

    // The poll still answers 200 with the current payload: a blip at Anthropic
    // is not the teacher's problem and costs them nothing.
    $this->getJson("/api/generations/{$generation->id}")->assertOk()
        ->assertJsonPath('status', 'running')
        ->assertJsonPath('agent_note', 'Earlier note.');

    $generation->refresh();
    expect($generation->status)->toBe(GenerationStatus::Running)
        ->and($generation->agent_note)->toBe('Earlier note.')
        ->and($generation->last_event_id)->toBe('sevt_0')
        ->and($generation->error)->toBeNull()
        ->and($generation->finished_at)->toBeNull()
        // The call WAS made and the exception WAS caught -- without this the
        // case would also pass if phase 1 never reached listEvents at all.
        ->and($fake->calls)->toHaveKey('listEvents');
});

test('a rejected session id fails the run and carries Anthropic message', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create(['session_id' => 'sesn_gone']);
    $fake->failNext('listEvents', new AnthropicRejected('no such session', 404));
    $this->actingAs($owner);

    $this->getJson("/api/generations/{$generation->id}")->assertOk()
        ->assertJsonPath('status', 'failed');

    $generation->refresh();
    // This is also where a key that is valid but not entitled to Managed
    // Agents, or out of credit, surfaces on a first generation.
    expect($generation->status)->toBe(GenerationStatus::Failed)
        ->and($generation->error)->toBe('Anthropic rejected the session: no such session')
        ->and($generation->finished_at)->not->toBeNull();
});

test('a valid save_test_draft call is answered once and finishes the run', function () {
    $fake = fakeAnthropic();
    $fake->returnsSessionCost(87);
    $owner = aTeacher();
    $integration = withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create([
        'session_id' => 'sesn_draft',
        'file_ids' => ['file_1', 'file_2'],
    ]);

    advanceEvents($fake, $generation, [
        ['id' => 'sevt_1', 'type' => 'agent.custom_tool_use', 'name' => 'save_test_draft', 'input' => validDraftBody()],
        // Everything after the call belongs to a turn that has not resumed: a
        // second save_test_draft in the same list is deliberately abandoned so
        // a run can never produce two tests (spec step 2).
        ['id' => 'sevt_2', 'type' => 'agent.message', 'content' => [['type' => 'text', 'text' => 'Should never be read.']]],
    ]);

    $generation->refresh();
    $test = $owner->tests()->first();

    expect($fake->calls['sendCustomToolResult'])->toHaveCount(1);
    [$key, $sessionId, $eventId, $content, $isError] = $fake->calls['sendCustomToolResult'][0];
    // The agent reads the decoded object, not our byte-for-byte encoding of it.
    $answer = json_decode($content[0]['text'], true);

    expect($key)->toBe($integration->apiKey())
        ->and($sessionId)->toBe('sesn_draft')
        ->and($eventId)->toBe('sevt_1')
        ->and($isError)->toBeFalse()
        ->and($answer['ok'])->toBeTrue()
        ->and($answer['test_id'])->toBe($test->id)
        ->and($answer['url'])->toEndWith("/tests/{$test->id}/edit")
        ->and($answer['url'])->toStartWith(FrontendRedirect::spaOrigin())
        // The draft itself, written through C1's validated path.
        ->and($test->visibility)->toBe(Visibility::Private)
        ->and($test->questions)->toHaveCount(5)
        ->and($test->questions->pluck('position')->all())->toBe([0, 1, 2, 3, 4])
        ->and($test->questions[0]->type)->toBe(QuestionType::MultipleChoice)
        // One question of every type, each answer round-tripped in the shape
        // the type uses (validDraftBody's own order).
        ->and($test->questions[0]->answer)->toBe(1)
        ->and($test->questions[1]->answer)->toBe([1, 2])
        ->and($test->questions[2]->answer)->toBeTrue()
        ->and($test->questions[3]->answer)->toBe('1/2')
        ->and($test->questions[4]->answer)->toBe(['value' => 2, 'tolerance' => 0])
        // A saved draft ends the run immediately (spec ruling 6).
        ->and($generation->status)->toBe(GenerationStatus::Done)
        ->and($generation->error)->toBeNull()
        ->and($generation->test_id)->toBe($test->id)
        ->and($generation->finished_at)->not->toBeNull()
        ->and($generation->pending_tool_event_id)->toBeNull()
        ->and($generation->pending_tool_result)->toBeNull()
        ->and($generation->last_event_id)->toBe('sevt_1')
        ->and($generation->agent_note)->toBeNull()
        ->and($generation->list_cost_cents)->toBe(87)
        ->and($fake->calls)->toHaveKey('interrupt')
        ->and($fake->calls)->toHaveKey('retrieveSession')
        ->and($fake->calls)->toHaveKey('archiveSession')
        ->and(array_map(fn ($args) => $args[1], $fake->calls['deleteFile']))->toBe(['file_1', 'file_2']);
});

test('an invalid save_test_draft call is answered as an error and the run continues', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create(['session_id' => 'sesn_bad']);

    advanceEvents($fake, $generation, [
        ['id' => 'sevt_1', 'type' => 'agent.custom_tool_use', 'name' => 'save_test_draft', 'input' => validDraftBody([
            'questions' => [
                // answer 9 with two options: QuestionRules::shapeError rejects it.
                ['type' => 'multiple_choice', 'prompt' => 'Pick one.', 'options' => ['a', 'b'], 'answer' => 9],
            ],
        ])],
    ]);

    $generation->refresh();
    expect($fake->calls['sendCustomToolResult'])->toHaveCount(1);
    [, , $eventId, $content, $isError] = $fake->calls['sendCustomToolResult'][0];

    expect($eventId)->toBe('sevt_1')
        ->and($isError)->toBeTrue()
        ->and($content[0]['text'])->toContain('index of one option')
        ->and(Test::count())->toBe(0)
        ->and($generation->test_id)->toBeNull()
        ->and($generation->tool_failures)->toBe(1)
        // One failure of three: the agent gets another turn, so the run goes
        // back to running and nothing is torn down.
        ->and($generation->status)->toBe(GenerationStatus::Running)
        ->and($generation->pending_tool_event_id)->toBeNull()
        ->and($generation->pending_tool_result)->toBeNull()
        ->and($generation->last_event_id)->toBe('sevt_1')
        ->and($generation->finished_at)->toBeNull()
        ->and($fake->calls)->not->toHaveKey('interrupt')
        ->and($fake->calls)->not->toHaveKey('archiveSession');
});

test('a tool call with another name is a marker and nothing else', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create(['session_id' => 'sesn_other']);

    advanceEvents($fake, $generation, [
        ['id' => 'sevt_1', 'type' => 'agent.custom_tool_use', 'name' => 'something_else', 'input' => ['x' => 1]],
        ['id' => 'sevt_2', 'type' => 'agent.message', 'content' => [['type' => 'text', 'text' => 'Carrying on.']]],
    ]);

    $generation->refresh();
    expect($generation->status)->toBe(GenerationStatus::Running)
        ->and($generation->pending_tool_event_id)->toBeNull()
        ->and($generation->tool_failures)->toBe(0)
        ->and($generation->agent_note)->toBe('Carrying on.')
        ->and($generation->last_event_id)->toBe('sevt_2');
});

test('a four-question draft is accepted: the requested count is advisory', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create([
        'session_id' => 'sesn_four',
        'question_count' => 10,
    ]);

    advanceEvents($fake, $generation, [
        ['id' => 'sevt_1', 'type' => 'agent.custom_tool_use', 'name' => 'save_test_draft', 'input' => validDraftBody([
            'questions' => [
                ['type' => 'true_false', 'prompt' => 'Water is wet.', 'answer' => true],
                ['type' => 'true_false', 'prompt' => 'Ice is cold.', 'answer' => true],
                ['type' => 'short_answer', 'prompt' => 'Name a state of matter.', 'answer' => 'gas'],
                ['type' => 'numeric', 'prompt' => 'Boiling point in Celsius?', 'answer' => ['value' => 100, 'tolerance' => 0]],
            ],
        ])],
    ]);

    // TestRules allows 1-100 questions; question_count shapes the brief, it is
    // not a validation rule. A short draft is a draft the teacher can edit.
    $test = $owner->tests()->first();
    expect(Test::count())->toBe(1)
        ->and($test->questions)->toHaveCount(4)
        ->and($generation->fresh()->test_id)->toBe($test->id);
});

test('a poll that owes a tool result does not read events', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create([
        'session_id' => 'sesn_owed',
        'status' => 'awaiting_tool',
        'pending_tool_event_id' => 'sevt_5',
        'pending_tool_result' => ['content' => [['type' => 'text', 'text' => '{"ok":true}']], 'is_error' => false],
    ]);
    $fake->queueEvents('sesn_owed', [
        ['id' => 'sevt_6', 'type' => 'agent.message', 'content' => [['type' => 'text', 'text' => 'Never read.']]],
    ]);
    $this->actingAs($owner);

    $this->getJson("/api/generations/{$generation->id}")->assertOk();

    // Step 1: a result is owed, so phase 1 hands straight over to phase 2
    // rather than reading one more event.
    expect($fake->calls)->not->toHaveKey('listEvents');
});

test('a marker that is not in the event list processes nothing', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create([
        'session_id' => 'sesn_lost',
        'last_event_id' => 'sevt_gone',
        'agent_note' => 'Earlier note.',
    ]);

    advanceEvents($fake, $generation, [
        ['id' => 'sevt_1', 'type' => 'agent.message', 'content' => [['type' => 'text', 'text' => 'Never read.']]],
        ['id' => 'sevt_2', 'type' => 'session.status_idle', 'stop_reason' => ['type' => 'end_turn']],
    ]);

    $generation->refresh();
    // Replaying from the head would re-run a save_test_draft and mint a second
    // test, so an unrecognisable marker means "process nothing at all" -- not
    // even the end_turn that would otherwise fail this run.
    expect($generation->agent_note)->toBe('Earlier note.')
        ->and($generation->last_event_id)->toBe('sevt_gone')
        ->and($generation->status)->toBe(GenerationStatus::Running)
        ->and($generation->finished_at)->toBeNull();
});

test('an idle with no stop reason at all still fails the run', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create(['session_id' => 'sesn_noreason']);

    advanceEvents($fake, $generation, [
        // No stop_reason key: SessionEvent flattens that to ''. An empty reason
        // is still not a reason we allowlist, so the row may not stay running.
        ['id' => 'sevt_1', 'type' => 'session.status_idle'],
    ]);

    $generation->refresh();
    expect($generation->status)->toBe(GenerationStatus::Failed)
        ->and($generation->error)->toBe(GenerationMessages::PLATFORM_STOPPED.': ')
        ->and($generation->finished_at)->not->toBeNull();
});

test('an oversized agent message is cut to whole characters', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create(['session_id' => 'sesn_long']);

    advanceEvents($fake, $generation, [
        // Two bytes per character, so 140 000 bytes into a 65 535-byte TEXT
        // column. mb_strcut is what keeps the cut off a character boundary:
        // substr() here would store a half-character and break the JSON payload.
        ['id' => 'sevt_1', 'type' => 'agent.message', 'content' => [['type' => 'text', 'text' => str_repeat('é', 70000)]]],
    ]);

    $note = $generation->refresh()->agent_note;
    expect(strlen($note))->toBeLessThanOrEqual(60000)
        ->and(mb_check_encoding($note, 'UTF-8'))->toBeTrue()
        ->and(mb_strlen($note))->toBe(30000);
});

test('a send that cannot reach Anthropic is retried by the next poll', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create(['session_id' => 'sesn_retry']);
    $fake->failNext('sendCustomToolResult', new AnthropicUnavailable('connection timed out', 503));

    advanceEvents($fake, $generation, [
        ['id' => 'sevt_1', 'type' => 'agent.custom_tool_use', 'name' => 'save_test_draft', 'input' => validDraftBody()],
    ]);

    $generation->refresh();
    // The decision is committed; only the send failed. The row waits.
    expect($generation->status)->toBe(GenerationStatus::AwaitingTool)
        ->and($generation->pending_tool_event_id)->toBe('sevt_1')
        ->and($generation->pending_tool_result['is_error'])->toBeFalse()
        ->and($generation->finished_at)->toBeNull();

    $this->actingAs($owner)->getJson("/api/generations/{$generation->id}")->assertOk()
        ->assertJsonPath('status', 'done');

    $generation->refresh();
    expect($generation->status)->toBe(GenerationStatus::Done)
        ->and($generation->pending_tool_event_id)->toBeNull()
        ->and($generation->last_event_id)->toBe('sevt_1')
        // One draft, not two: the second poll never re-read the events.
        ->and(Test::count())->toBe(1);

    // Two ATTEMPTS, one ACCEPTED result. The fake records the call and then
    // throws the scripted failure, so the failed attempt is in $calls too; what
    // the lock and the stored event id guarantee is one accepted result per
    // event id, which is why both attempts carry the same one.
    expect($fake->calls['sendCustomToolResult'])->toHaveCount(2)
        ->and($fake->calls['sendCustomToolResult'][0][2])->toBe('sevt_1')
        ->and($fake->calls['sendCustomToolResult'][1][2])->toBe('sevt_1');
});

test('a send rejected as already answered is treated as sent', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create(['session_id' => 'sesn_dup']);
    $fake->failNext('sendCustomToolResult', new AnthropicRejected('already answered', 400));

    advanceEvents($fake, $generation, [
        ['id' => 'sevt_1', 'type' => 'agent.custom_tool_use', 'name' => 'save_test_draft', 'input' => validDraftBody()],
    ]);

    $generation->refresh();
    // The likeliest cause is a previous send Anthropic accepted before the
    // process died; retrying forever would strand the run.
    expect($generation->status)->toBe(GenerationStatus::Done)
        ->and($generation->pending_tool_event_id)->toBeNull()
        ->and($generation->pending_tool_result)->toBeNull()
        ->and($generation->finished_at)->not->toBeNull()
        ->and(Test::count())->toBe(1)
        ->and($fake->calls)->toHaveKey('archiveSession');
});

test('three rejected drafts end the run', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create(['session_id' => 'sesn_strikes']);
    $bad = validDraftBody([
        'questions' => [
            ['type' => 'multiple_choice', 'prompt' => 'Pick one.', 'options' => ['a', 'b'], 'answer' => 9],
        ],
    ]);

    // One new tool_use event per poll, exactly as a corrected-but-still-wrong
    // agent would produce.
    foreach (['sevt_1', 'sevt_2', 'sevt_3'] as $eventId) {
        advanceEvents($fake, $generation, [
            ['id' => $eventId, 'type' => 'agent.custom_tool_use', 'name' => 'save_test_draft', 'input' => $bad],
        ]);
    }

    $generation->refresh();
    expect(config('generation.max_tool_failures'))->toBe(3)
        ->and($generation->tool_failures)->toBe(3)
        ->and($generation->status)->toBe(GenerationStatus::Failed)
        ->and($generation->error)->toBe('The draft was rejected 3 times.')
        ->and($generation->error)->toBe(GenerationMessages::rejected())
        ->and($generation->finished_at)->not->toBeNull()
        // The third error result is still sent -- the agent is told why the run
        // ended -- and only then is the session torn down.
        ->and($fake->calls['sendCustomToolResult'])->toHaveCount(3)
        ->and($fake->calls)->toHaveKey('interrupt')
        ->and($fake->calls)->toHaveKey('archiveSession')
        ->and(Test::count())->toBe(0);
});

test('two sequential advances over one pending tool call accept exactly one send', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create(['session_id' => 'sesn_once']);
    $fake->queueEvents('sesn_once', [
        ['id' => 'sevt_1', 'type' => 'agent.custom_tool_use', 'name' => 'save_test_draft', 'input' => validDraftBody()],
    ]);

    // Straight through the advancer twice, no HTTP: the second call finds the
    // terminal row the first one left and stops at step 0. This is the
    // at-most-once guarantee the cache lock exists for (spec decision 13).
    app(GenerationAdvancer::class)->advance($generation);
    app(GenerationAdvancer::class)->advance($generation->fresh());

    expect($fake->calls['sendCustomToolResult'])->toHaveCount(1)
        ->and(Test::count())->toBe(1)
        ->and($generation->fresh()->status)->toBe(GenerationStatus::Done);
});

test('a second save_test_draft in one run is refused instead of written twice', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $existing = Test::factory()->for($owner, 'author')->create();
    $generation = Generation::factory()->for($owner)->create([
        'session_id' => 'sesn_second',
        'test_id' => $existing->id,
    ]);

    advanceEvents($fake, $generation, [
        ['id' => 'sevt_1', 'type' => 'agent.custom_tool_use', 'name' => 'save_test_draft', 'input' => validDraftBody()],
    ]);

    $generation->refresh();
    [, , $eventId, $content, $isError] = $fake->calls['sendCustomToolResult'][0];

    // Defensive only: an accepted draft ends the run `done`, so a running row
    // that already has a test_id should be unreachable. If it ever happens the
    // agent is told no, rather than the teacher getting two drafts from one run.
    expect(Test::count())->toBe(1)
        ->and($generation->test_id)->toBe($existing->id)
        ->and($eventId)->toBe('sevt_1')
        ->and($isError)->toBeTrue()
        ->and($content[0]['text'])->toBe('A draft was already saved for this run.')
        ->and($generation->tool_failures)->toBe(0)
        ->and($generation->status)->toBe(GenerationStatus::Running)
        ->and($generation->pending_tool_event_id)->toBeNull();
});

test('a save_test_draft call with no id fails the run because it cannot be answered', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->create(['session_id' => 'sesn_noid']);

    advanceEvents($fake, $generation, [
        ['id' => '', 'type' => 'agent.custom_tool_use', 'name' => 'save_test_draft', 'input' => validDraftBody()],
    ]);

    $generation->refresh();
    // A result is addressed to the tool_use event's id. Without one there is
    // nothing to answer, and an unanswered call would park the session until
    // the wall-clock cap, billing the teacher for the wait.
    expect($generation->status)->toBe(GenerationStatus::Failed)
        ->and($generation->error)->toBe('Anthropic stopped the session: tool call without an id')
        ->and($generation->error)->toBe(GenerationMessages::PLATFORM_STOPPED.': tool call without an id')
        ->and($generation->finished_at)->not->toBeNull()
        ->and($generation->last_event_id)->toBeNull()
        ->and(Test::count())->toBe(0)
        ->and($fake->calls)->not->toHaveKey('sendCustomToolResult')
        ->and($fake->calls)->toHaveKey('archiveSession');
});
