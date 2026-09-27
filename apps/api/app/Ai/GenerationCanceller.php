<?php

namespace App\Ai;

use App\Enums\GenerationStatus;
use App\Models\Generation;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Support\Facades\Cache;

/**
 * The lock sequence for ending a run or cleaning up after one: lock,
 * re-read, act, release. The teacher's cancel endpoint, the admin page and
 * both sweep passes call this rather than carrying their own copy of the
 * dance. IntegrationTeardown still carries one (a key-removal cancel with
 * KEY_REMOVED); rewiring it is a follow-up on its own branch.
 *
 * The lock is the same one every poll takes (Generation::lockKey), but
 * blocking: a cancel is a deliberate action and is worth waiting a few
 * seconds for. The lifetime exceeds the worst-case advance (a multi-page
 * listEvents plus one send, each bounded by the 60 s request timeout).
 */
final class GenerationCanceller
{
    private const LOCK_SECONDS = 180;

    private const BLOCK_SECONDS = 5;

    public function __construct(private readonly SessionTeardown $teardown) {}

    /**
     * Tear the session down and mark the row cancelled. $reason is written
     * to `error`: null for a teacher's own cancel (not a failure), a
     * GenerationMessages sentence for a system or admin cancel.
     */
    public function cancel(Generation $generation, ?string $reason): CancelOutcome
    {
        $lock = Cache::lock($generation->lockKey(), self::LOCK_SECONDS);

        try {
            $lock->block(self::BLOCK_SECONDS);
        } catch (LockTimeoutException) {
            return CancelOutcome::Busy;
        }

        try {
            // The caller's instance was read before the block above could
            // have waited; re-read what the lock actually protects before
            // trusting its status, or a concurrent holder's terminal write
            // is undone.
            $generation->refresh();

            if ($generation->isTerminal()) {
                return CancelOutcome::AlreadyTerminal;
            }

            $this->teardown->run($generation);
            $generation->markTerminal(GenerationStatus::Cancelled, $reason);

            return CancelOutcome::Cancelled;
        } finally {
            $lock->release();
        }
    }

    /**
     * Run the teardown again on a finished row that still has undeleted
     * files or an unarchived session. Nothing for a clean row -- and nothing
     * for a live one, which hasLeftovers() never says yes to.
     */
    public function retryTeardown(Generation $generation): TeardownOutcome
    {
        $lock = Cache::lock($generation->lockKey(), self::LOCK_SECONDS);

        try {
            $lock->block(self::BLOCK_SECONDS);
        } catch (LockTimeoutException) {
            return TeardownOutcome::Busy;
        }

        try {
            $generation->refresh();

            if (! $generation->hasLeftovers()) {
                return TeardownOutcome::NothingToDo;
            }

            $this->teardown->run($generation);

            return TeardownOutcome::Ran;
        } finally {
            $lock->release();
        }
    }
}
