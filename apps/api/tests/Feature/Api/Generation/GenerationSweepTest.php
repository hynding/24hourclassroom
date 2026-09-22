<?php

use App\Enums\GenerationStatus;
use App\Models\Generation;
use App\Models\Integration;
use App\Support\GenerationMessages;

beforeEach(function () {
    fakeAnthropic();
});

test('the sweep cancels only the runs past the cap', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $cap = (int) config('generation.max_run_minutes');

    $stale = Generation::factory()->for($owner)->create([
        'session_id' => 'sesn_stale',
        'started_at' => now()->subMinutes($cap + 1),
    ]);
    $fresh = Generation::factory()->for($owner)->create([
        'session_id' => 'sesn_fresh',
        'started_at' => now()->subMinutes(5),
    ]);
    $finished = Generation::factory()->for($owner)->done()->create([
        'session_id' => 'sesn_done',
        'started_at' => now()->subMinutes(90),
    ]);

    $this->artisan('generations:sweep')
        ->expectsOutput('Cancelled 1 generation(s); retried 0 teardown(s).')
        ->assertExitCode(0);

    expect($stale->fresh()->status)->toBe(GenerationStatus::Cancelled)
        ->and($stale->fresh()->error)->toBe(GenerationMessages::TIMED_OUT)
        ->and($stale->fresh()->finished_at)->not->toBeNull()
        // Inside the cap: untouched.
        ->and($fresh->fresh()->status)->toBe(GenerationStatus::Running)
        ->and($fresh->fresh()->error)->toBeNull()
        // Terminal already: live() never selected it, however old it is.
        ->and($finished->fresh()->status)->toBe(GenerationStatus::Done)
        ->and(array_map(fn ($args) => $args[1], $fake->calls['interrupt']))->toBe(['sesn_stale']);
});

test('each row is torn down under its own owners key', function () {
    $fake = fakeAnthropic();
    $cap = (int) config('generation.max_run_minutes');

    $a = aTeacher();
    withAnthropicKey($a)->update(['anthropic_api_key' => 'sk-ant-owner-a']);
    $b = aTeacher();
    withAnthropicKey($b)->update(['anthropic_api_key' => 'sk-ant-owner-b']);

    Generation::factory()->for($a)->create(['session_id' => 'sesn_a', 'started_at' => now()->subMinutes($cap + 1)]);
    Generation::factory()->for($b)->create(['session_id' => 'sesn_b', 'started_at' => now()->subMinutes($cap + 1)]);

    $this->artisan('generations:sweep')
        ->expectsOutput('Cancelled 2 generation(s); retried 0 teardown(s).')
        ->assertExitCode(0);

    // Every session lives in ITS OWN teacher's Anthropic org (spec decision 5),
    // so a sweep that used one key for both rows would talk to the wrong org.
    $keysBySession = [];
    foreach ($fake->calls['interrupt'] as [$key, $sessionId]) {
        $keysBySession[$sessionId] = $key;
    }

    expect($keysBySession)->toBe(['sesn_a' => 'sk-ant-owner-a', 'sesn_b' => 'sk-ant-owner-b']);
});

test('a row whose owner has no key is cancelled locally', function () {
    $fake = fakeAnthropic();
    $cap = (int) config('generation.max_run_minutes');

    $keyed = aTeacher();
    withAnthropicKey($keyed);
    $keyless = aTeacher();

    $withKey = Generation::factory()->for($keyed)->create(['session_id' => 'sesn_keyed', 'started_at' => now()->subMinutes($cap + 1)]);
    $withoutKey = Generation::factory()->for($keyless)->create(['session_id' => 'sesn_orphan', 'started_at' => now()->subMinutes($cap + 1)]);

    $this->artisan('generations:sweep')
        ->expectsOutput('Cancelled 2 generation(s); retried 0 teardown(s).')
        ->assertExitCode(0);

    expect($withKey->fresh()->status)->toBe(GenerationStatus::Cancelled)
        ->and($withoutKey->fresh()->status)->toBe(GenerationStatus::Cancelled)
        ->and($withoutKey->fresh()->error)->toBe(GenerationMessages::TIMED_OUT)
        // Only the keyed row can be reached at Anthropic; the other is
        // cancelled in our database and nowhere else.
        ->and(array_map(fn ($args) => $args[1], $fake->calls['interrupt']))->toBe(['sesn_keyed']);
});

test('a queued row that never got a session is cancelled with no gateway call', function () {
    $fake = fakeAnthropic();
    $cap = (int) config('generation.max_run_minutes');
    $owner = aTeacher();
    withAnthropicKey($owner);

    // coalesce(started_at, created_at): a queued row has no started_at, so the
    // cap is measured from created_at. A poll would report the more specific
    // NEVER_STARTED through the advancer's step 0; the sweep only knows about
    // the cap, and either way the row stops being live.
    $generation = Generation::factory()->for($owner)->queued()->create([
        'created_at' => now()->subMinutes($cap + 1),
    ]);

    $this->artisan('generations:sweep')
        ->expectsOutput('Cancelled 1 generation(s); retried 0 teardown(s).')
        ->assertExitCode(0);

    expect($generation->fresh()->status)->toBe(GenerationStatus::Cancelled)
        ->and($generation->fresh()->error)->toBe(GenerationMessages::TIMED_OUT)
        ->and($generation->fresh()->finished_at)->not->toBeNull()
        ->and($fake->calls)->toBe([]);
});

test('the second pass retries a terminal row whose files were never deleted', function () {
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $fake = fakeAnthropic();
    $generation = Generation::factory()->for($teacher)->create([
        'status' => 'failed', 'session_id' => 'sesn_9', 'file_ids' => ['file_7'],
        'archived_at' => null, 'teardown_attempts' => 1, 'finished_at' => now(),
    ]);

    $this->artisan('generations:sweep')
        ->expectsOutput('Cancelled 0 generation(s); retried 1 teardown(s).')
        ->assertExitCode(0);

    $generation->refresh();
    expect($fake->calls['deleteFile'][0][1])->toBe('file_7')
        ->and($fake->calls['archiveSession'][0][1])->toBe('sesn_9')
        ->and($generation->file_ids)->toBeNull()
        ->and($generation->archived_at)->not->toBeNull()
        ->and($generation->teardown_attempts)->toBe(2)
        ->and($generation->status)->toBe(GenerationStatus::Failed);
});

test('the second pass skips a leftover whose owner has no key', function () {
    $fake = fakeAnthropic();

    // Two ways to have no key: no integration row at all, and a row whose key
    // the teacher removed.
    $never = aTeacher();
    $removed = aTeacher();
    Integration::factory()->create(['user_id' => $removed->id, 'anthropic_api_key' => null]);

    $rows = collect([$never, $removed])->map(fn ($owner) => Generation::factory()->for($owner)->create([
        'status' => 'failed', 'session_id' => 'sesn_'.$owner->id, 'file_ids' => ['file_7'],
        'archived_at' => null, 'teardown_attempts' => 1, 'finished_at' => now(),
    ]));

    $this->artisan('generations:sweep')
        ->expectsOutput('Cancelled 0 generation(s); retried 0 teardown(s).')
        ->assertExitCode(0);

    // Every step of the teardown needs the owner's key, so a retry would spend
    // one of five attempts without making a single call -- and the file ids
    // must survive for a teardown after the teacher adds a new key.
    expect($fake->calls)->toBe([]);

    foreach ($rows as $generation) {
        expect($generation->fresh()->teardown_attempts)->toBe(1)
            ->and($generation->fresh()->file_ids)->toBe(['file_7'])
            ->and($generation->fresh()->archived_at)->toBeNull();
    }
});

test('the second pass gives up after five attempts', function () {
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $fake = fakeAnthropic();
    Generation::factory()->for($teacher)->create([
        'status' => 'cancelled', 'session_id' => 'sesn_9', 'file_ids' => ['file_7'],
        'archived_at' => null, 'teardown_attempts' => 5, 'finished_at' => now(),
    ]);

    $this->artisan('generations:sweep')
        ->expectsOutput('Cancelled 0 generation(s); retried 0 teardown(s).')
        ->assertExitCode(0);

    expect($fake->calls)->toBe([]);
});
