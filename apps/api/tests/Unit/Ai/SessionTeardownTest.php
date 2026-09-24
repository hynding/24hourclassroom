<?php

use App\Ai\Exceptions\AnthropicUnavailable;
use App\Ai\SessionTeardown;
use App\Ai\Sleeper;
use App\Models\Generation;
use App\Models\Integration;
use Illuminate\Support\Facades\Log;

beforeEach(function () {
    $this->fake = fakeAnthropic();

    // A counting sleeper in place of the no-op, so the between-retry wait is
    // observable without the test taking five seconds.
    $this->sleeper = new class implements Sleeper
    {
        public int $slept = 0;

        public function sleep(int $seconds): void
        {
            $this->slept++;
        }
    };

    app()->instance(Sleeper::class, $this->sleeper);
});

test('a live session is interrupted, waited out, costed, archived, and its files deleted', function () {
    $teacher = aTeacher();
    $key = withAnthropicKey($teacher)->apiKey();

    // Interrupt is asynchronous: the session answers "running" twice before it
    // settles, and archive is rejected while it runs.
    $this->fake->returnsSessionStatuses(['running', 'running', 'idle']);
    $this->fake->returnsSessionCost(275);

    $generation = Generation::factory()->create([
        'user_id' => $teacher->id,
        'session_id' => 'sesn_1',
        'file_ids' => ['file_1', 'file_2'],
    ]);

    app(SessionTeardown::class)->run($generation);

    expect($this->fake->calls['interrupt'][0])->toBe([$key, 'sesn_1'])
        ->and($this->fake->calls['retrieveSession'])->toHaveCount(3)
        ->and($this->sleeper->slept)->toBe(2)
        ->and($this->fake->calls['archiveSession'][0])->toBe([$key, 'sesn_1'])
        ->and(array_map(fn (array $call) => $call[1], $this->fake->calls['deleteFile']))->toBe(['file_1', 'file_2'])
        ->and($this->fake->calls['deleteFile'][0][0])->toBe($key);

    $fresh = $generation->fresh();
    expect($fresh->list_cost_cents)->toBe(275)
        // Nulled so nothing tries to delete the same ids twice.
        ->and($fresh->file_ids)->toBeNull()
        ->and($fresh->archived_at)->not->toBeNull()
        ->and($fresh->teardown_attempts)->toBe(1);
});

test('a session that never settles is not archived, but its files are still deleted', function () {
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $this->fake->returnsSessionStatus('running');

    $generation = Generation::factory()->create([
        'user_id' => $teacher->id,
        'session_id' => 'sesn_1',
        'file_ids' => ['file_1'],
    ]);

    app(SessionTeardown::class)->run($generation);

    expect($this->fake->calls['retrieveSession'])->toHaveCount(5)
        ->and($this->sleeper->slept)->toBe(4)
        ->and($this->fake->calls)->not->toHaveKey('archiveSession')
        ->and($this->fake->calls['deleteFile'])->toHaveCount(1);

    $fresh = $generation->fresh();
    expect($fresh->file_ids)->toBeNull()
        // Five confirmed "running" answers: never archived, so the sweep
        // must retry this row.
        ->and($fresh->archived_at)->toBeNull()
        ->and($fresh->teardown_attempts)->toBe(1);
});

test('without a session id the session steps are skipped and the uploads are still cleaned up', function () {
    // The failed-create case: uploads happened, createSession did not.
    $teacher = aTeacher();
    withAnthropicKey($teacher);

    $generation = Generation::factory()->create([
        'user_id' => $teacher->id,
        'session_id' => null,
        'file_ids' => ['file_9'],
    ]);

    app(SessionTeardown::class)->run($generation);

    expect($this->fake->calls)->not->toHaveKey('interrupt')
        ->and($this->fake->calls)->not->toHaveKey('retrieveSession')
        ->and($this->fake->calls)->not->toHaveKey('archiveSession')
        ->and($this->fake->calls['deleteFile'][0][1])->toBe('file_9');

    $fresh = $generation->fresh();
    expect($fresh->file_ids)->toBeNull()
        // No session ever existed, so there is nothing to archive -- this
        // counts as done immediately.
        ->and($fresh->archived_at)->not->toBeNull()
        ->and($fresh->teardown_attempts)->toBe(1);
});

test('without a key nothing is called at all and the file ids are left for a later key to clean up', function () {
    // Changed from the old all-or-nothing behaviour: file_ids used to be
    // force-nulled here on the theory that a key-less generation could never
    // be cleaned up. But a teacher can add a new key later, and nothing was
    // actually deleted, so the ids must stay put for a future teardown run to
    // find and finish -- exactly like a failed deleteFile call.
    $teacher = aTeacher();
    Integration::create(['user_id' => $teacher->id]);

    $generation = Generation::factory()->create([
        'user_id' => $teacher->id,
        'session_id' => 'sesn_1',
        'file_ids' => ['file_1'],
    ]);

    app(SessionTeardown::class)->run($generation);

    expect($this->fake->calls)->toBe([]);

    $fresh = $generation->fresh();
    expect($fresh->file_ids)->toBe(['file_1'])
        ->and($fresh->archived_at)->toBeNull()
        ->and($fresh->teardown_attempts)->toBe(1);
});

test('a failing archive is logged and the files are deleted anyway', function () {
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $this->fake->failNext('archiveSession', new AnthropicUnavailable('down', 503));

    Log::spy();

    $generation = Generation::factory()->create([
        'user_id' => $teacher->id,
        'session_id' => 'sesn_1',
        'file_ids' => ['file_1', 'file_2'],
    ]);

    app(SessionTeardown::class)->run($generation);

    Log::shouldHaveReceived('warning');

    expect($this->fake->calls['archiveSession'])->toHaveCount(1)
        ->and($this->fake->calls['deleteFile'])->toHaveCount(2);

    $fresh = $generation->fresh();
    expect($fresh->file_ids)->toBeNull()
        // The archive call itself threw -- not archived, retryable.
        ->and($fresh->archived_at)->toBeNull()
        ->and($fresh->teardown_attempts)->toBe(1);
});

test('a failed status read does not skip the archive, and the files are deleted anyway', function () {
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $this->fake->failNext('retrieveSession', new AnthropicUnavailable('down', 503));

    Log::spy();

    $generation = Generation::factory()->create([
        'user_id' => $teacher->id,
        'session_id' => 'sesn_1',
        'file_ids' => ['file_1', 'file_2'],
    ]);

    app(SessionTeardown::class)->run($generation);

    Log::shouldHaveReceived('warning');

    expect($this->fake->calls['archiveSession'])->toHaveCount(1)
        ->and($this->fake->calls['deleteFile'])->toHaveCount(2);

    $fresh = $generation->fresh();
    expect($fresh->file_ids)->toBeNull()
        // The read failed but archive was still attempted and succeeded.
        ->and($fresh->archived_at)->not->toBeNull()
        ->and($fresh->teardown_attempts)->toBe(1);
});

test('a file that fails to delete is kept, in order, and a later one that succeeds is dropped', function () {
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    // THE INVARIANT (see FakeAnthropicGateway): record() runs before the
    // queued failure is thrown, so this is the FIRST deleteFile call -- for
    // file_1 -- that throws; file_2's call is unarmed and succeeds.
    $this->fake->failNext('deleteFile', new AnthropicUnavailable('x', 503));

    Log::spy();

    $generation = Generation::factory()->create([
        'user_id' => $teacher->id,
        'session_id' => 'sesn_1',
        'file_ids' => ['file_1', 'file_2'],
    ]);

    app(SessionTeardown::class)->run($generation);

    Log::shouldHaveReceived('warning');

    expect($this->fake->calls['deleteFile'])->toHaveCount(2);

    $fresh = $generation->fresh();
    expect($fresh->file_ids)->toBe(['file_1'])
        ->and($fresh->archived_at)->not->toBeNull()
        ->and($fresh->teardown_attempts)->toBe(1);
});
