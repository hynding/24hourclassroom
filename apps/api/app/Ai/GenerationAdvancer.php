<?php

namespace App\Ai;

use App\Enums\GenerationStatus;
use App\Models\Generation;
use App\Models\Integration;
use App\Support\GenerationMessages;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

final class GenerationAdvancer
{
    /**
     * True when THIS call moved the row to a terminal status. Phase 2 reads it
     * to decide whether the teardown still has to run. It is reset at the top
     * of every advance() so a reused instance cannot leak the flag.
     */
    private bool $endedThisCall = false;

    public function __construct(
        private readonly AnthropicGateway $gateway,
        private readonly SessionTeardown $teardown,
    ) {}

    public function advance(Generation $generation): void
    {
        // Non-blocking (spec decision 13): a poll that arrives while another
        // poll is mid-advance serves the current payload instead of queueing
        // behind a 60 s HTTP call. The 180 s lifetime exceeds the worst-case
        // advance -- a multi-page listEvents plus one send, each bounded by the
        // gateway's 60 s request timeout.
        $lock = Cache::lock($generation->lockKey(), 180);

        if (! $lock->get()) {
            return;
        }

        $this->endedThisCall = false;

        try {
            $this->decide($generation);
            $this->settle($generation);
        } finally {
            $lock->release();
        }
    }

    /** Phase 1: decide and commit. No event is ever SENT from here. */
    private function decide(Generation $generation): void
    {
        $key = Integration::forUser($generation->user)->apiKey();

        // Step 0 needs no network, so it commits on its own.
        DB::transaction(function () use ($generation, $key): void {
            $this->lockRow($generation);

            if ($generation->isTerminal()) {
                return;
            }

            if ($this->failNeverStarted($generation)) {
                return;
            }

            if ($this->cancelTimedOut($generation)) {
                return;
            }

            $this->cancelKeyRemoved($generation, $key);
        });
    }

    /** Phase 2: outside every transaction, still inside the cache lock. */
    private function settle(Generation $generation): void
    {
        if ($this->endedThisCall) {
            // The teardown runs after every terminal transition. With no
            // session id, or no key, it skips the session steps and still
            // deletes file_ids, so an upload never outlives its run.
            $this->teardown->run($generation);
        }
    }

    /**
     * Belt and braces (spec decision 13): the cache lock is the guard, but a
     * row lock makes a second PHP process -- the sweep, say -- wait for this
     * commit instead of interleaving its own write, and the refresh() re-reads
     * the row we just locked so every decision below is made on committed
     * state rather than on whatever the controller happened to hold.
     */
    private function lockRow(Generation $generation): void
    {
        Generation::whereKey($generation->id)->lockForUpdate()->first();
        $generation->refresh();
    }

    private function failNeverStarted(Generation $generation): bool
    {
        // The create request died between the row insert and createSession.
        if ($generation->status === GenerationStatus::Queued && $generation->session_id === null) {
            return $this->terminate($generation, GenerationStatus::Failed, GenerationMessages::NEVER_STARTED);
        }

        return false;
    }

    private function cancelTimedOut(Generation $generation): bool
    {
        // coalesce(started_at, created_at): a row that never reached `running`
        // has no started_at, and list cost bills session running time either
        // way, so the cap is measured from whichever exists.
        $since = $generation->started_at ?? $generation->created_at;

        if ($since->lt(now()->subMinutes((int) config('generation.max_run_minutes')))) {
            return $this->terminate($generation, GenerationStatus::Cancelled, GenerationMessages::TIMED_OUT);
        }

        return false;
    }

    private function cancelKeyRemoved(Generation $generation, ?string $key): bool
    {
        // Only reachable when IntegrationTeardown's own cancel pass missed the
        // row; the same constant the DELETE uses, so the teacher reads one
        // explanation wherever they see it.
        if ($key === null) {
            return $this->terminate($generation, GenerationStatus::Cancelled, GenerationMessages::KEY_REMOVED);
        }

        return false;
    }

    /**
     * The one terminal write. markTerminal() sets the status, the truncated
     * error, finished_at, and clears the pending tool columns -- spec step 1: a
     * result owed to a run we are abandoning is never sent. Returns true so
     * callers can use it as "stop here".
     */
    private function terminate(Generation $generation, GenerationStatus $status, ?string $error = null): bool
    {
        $generation->markTerminal($status, $error);
        $this->endedThisCall = true;

        return true;
    }
}
