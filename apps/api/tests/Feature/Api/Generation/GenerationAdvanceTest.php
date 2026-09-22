<?php

use App\Ai\Exceptions\AnthropicRejected;
use App\Ai\Exceptions\AnthropicUnavailable;
use App\Ai\FakeAnthropicGateway;
use App\Ai\GenerationAdvancer;
use App\Enums\GenerationStatus;
use App\Models\Generation;
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
        ->and($generation->finished_at)->toBeNull();
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
