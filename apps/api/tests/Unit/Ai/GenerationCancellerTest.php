<?php

use App\Ai\CancelOutcome;
use App\Ai\GenerationCanceller;
use App\Ai\TeardownOutcome;
use App\Enums\GenerationStatus;
use App\Models\Generation;
use App\Support\GenerationMessages;
use Illuminate\Support\Facades\Cache;

beforeEach(function () {
    $this->fake = fakeAnthropic();
});

test('cancel tears the session down and marks the row cancelled with the given reason', function () {
    $teacher = aTeacher();
    $key = withAnthropicKey($teacher)->apiKey();
    $this->fake->returnsSessionCost(150);
    $generation = Generation::factory()->for($teacher)->create(['session_id' => 'sesn_1', 'file_ids' => ['file_1']]);

    $outcome = app(GenerationCanceller::class)->cancel($generation, GenerationMessages::TIMED_OUT);

    $fresh = $generation->fresh();
    expect($outcome)->toBe(CancelOutcome::Cancelled)
        ->and($fresh->status)->toBe(GenerationStatus::Cancelled)
        ->and($fresh->error)->toBe(GenerationMessages::TIMED_OUT)
        ->and($fresh->finished_at)->not->toBeNull()
        ->and($fresh->list_cost_cents)->toBe(150)
        ->and($fresh->file_ids)->toBeNull()
        ->and($this->fake->calls['interrupt'][0])->toBe([$key, 'sesn_1'])
        ->and($this->fake->calls['archiveSession'][0])->toBe([$key, 'sesn_1'])
        ->and($this->fake->calls['deleteFile'][0])->toBe([$key, 'file_1']);
});

test('cancel with a null reason writes no error sentence', function () {
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $generation = Generation::factory()->for($teacher)->create();

    expect(app(GenerationCanceller::class)->cancel($generation, null))->toBe(CancelOutcome::Cancelled)
        ->and($generation->fresh()->status)->toBe(GenerationStatus::Cancelled)
        ->and($generation->fresh()->error)->toBeNull();
});

test('cancel on a terminal row is AlreadyTerminal and touches nothing', function () {
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $generation = Generation::factory()->for($teacher)->done()->create(['session_id' => 'sesn_1']);
    // Read back rather than trusting the in-memory Carbon: the column is second-precision.
    $finishedAt = $generation->fresh()->finished_at;

    expect(app(GenerationCanceller::class)->cancel($generation, GenerationMessages::TIMED_OUT))->toBe(CancelOutcome::AlreadyTerminal)
        ->and($this->fake->calls)->toBe([])
        ->and($generation->fresh()->status)->toBe(GenerationStatus::Done)
        ->and($generation->fresh()->error)->toBeNull()
        ->and($generation->fresh()->finished_at->equalTo($finishedAt))->toBeTrue();
});

test('cancel re-reads the row inside the lock, so a concurrent terminal write beats the stale instance', function () {
    // The race the lock exists for: something else finished the row between
    // the caller's read and the lock. No Request or controller needed -- the
    // canceller takes a model, so the pre-block read is simply a stale instance.
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $generation = Generation::factory()->for($teacher)->create(['session_id' => 'sesn_1']);
    $stale = Generation::find($generation->id);

    Generation::whereKey($generation->id)->update([
        'status' => GenerationStatus::Cancelled,
        'error' => GenerationMessages::KEY_REMOVED,
        'finished_at' => now(),
    ]);

    expect(app(GenerationCanceller::class)->cancel($stale, GenerationMessages::TIMED_OUT))->toBe(CancelOutcome::AlreadyTerminal)
        ->and($generation->fresh()->error)->toBe(GenerationMessages::KEY_REMOVED)
        ->and($this->fake->calls)->toBe([]);
});

test('retryTeardown runs the teardown on a terminal row with leftovers', function () {
    $teacher = aTeacher();
    $key = withAnthropicKey($teacher)->apiKey();
    $generation = Generation::factory()->for($teacher)->create([
        'status' => 'failed', 'session_id' => 'sesn_9', 'file_ids' => ['file_7'],
        'archived_at' => null, 'teardown_attempts' => 1, 'finished_at' => now(),
    ]);

    expect(app(GenerationCanceller::class)->retryTeardown($generation))->toBe(TeardownOutcome::Ran);

    $generation->refresh();
    expect($this->fake->calls['deleteFile'][0])->toBe([$key, 'file_7'])
        ->and($this->fake->calls['archiveSession'][0])->toBe([$key, 'sesn_9'])
        ->and($generation->file_ids)->toBeNull()
        ->and($generation->archived_at)->not->toBeNull()
        ->and($generation->teardown_attempts)->toBe(2)
        ->and($generation->status)->toBe(GenerationStatus::Failed);
});

test('retryTeardown is NothingToDo on a clean terminal row and on a live row alike', function () {
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $clean = Generation::factory()->for($teacher)->done()->create(['session_id' => 'sesn_1']);
    // A session and no archived_at on a RUNNING row is a run in progress, not
    // a leftover: the retry must not archive it out from under the teacher.
    $live = Generation::factory()->for($teacher)->create(['session_id' => 'sesn_2', 'archived_at' => null, 'file_ids' => ['file_1']]);

    $canceller = app(GenerationCanceller::class);

    expect($canceller->retryTeardown($clean))->toBe(TeardownOutcome::NothingToDo)
        ->and($canceller->retryTeardown($live))->toBe(TeardownOutcome::NothingToDo)
        ->and($this->fake->calls)->toBe([])
        ->and($live->fresh()->status)->toBe(GenerationStatus::Running)
        ->and($live->fresh()->file_ids)->toBe(['file_1'])
        ->and($live->fresh()->teardown_attempts)->toBe(0)
        ->and($clean->fresh()->teardown_attempts)->toBe(0);
});

test('both methods are Busy when the lock cannot be taken inside five seconds', function () {
    // NOTE: this test really takes about ten seconds -- the blocking window is
    // the contract, once per method, and a shorter one would not prove it.
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $generation = Generation::factory()->for($teacher)->create(['session_id' => 'sesn_1', 'file_ids' => ['file_1']]);

    $lock = Cache::lock($generation->lockKey(), 180);
    expect($lock->get())->toBeTrue();

    $canceller = app(GenerationCanceller::class);

    expect($canceller->cancel($generation, null))->toBe(CancelOutcome::Busy)
        ->and($canceller->retryTeardown($generation))->toBe(TeardownOutcome::Busy)
        ->and($generation->fresh()->status)->toBe(GenerationStatus::Running)
        ->and($generation->fresh()->teardown_attempts)->toBe(0)
        ->and($this->fake->calls)->toBe([]);

    $lock->release();
});
