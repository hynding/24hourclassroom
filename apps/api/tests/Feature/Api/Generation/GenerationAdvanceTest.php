<?php

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
