<?php

namespace App\Console\Commands;

use App\Ai\SessionTeardown;
use App\Enums\GenerationStatus;
use App\Models\Generation;
use App\Support\GenerationMessages;
use Illuminate\Console\Command;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Support\Facades\Cache;

class SweepGenerations extends Command
{
    protected $signature = 'generations:sweep';

    protected $description = 'Cancel generations that have been running longer than generation.max_run_minutes';

    public function handle(SessionTeardown $teardown): int
    {
        $cutoff = now()->subMinutes((int) config('generation.max_run_minutes'));
        $cancelled = 0;

        // whereRaw rather than DB::raw in the where(): one placeholder, one
        // binding, and the same SQL on MySQL and SQLite. An abandoned run is
        // not free -- list cost includes session running time at $0.08/h
        // (spec decision 7) -- so the cap is measured from whichever timestamp
        // the row actually has.
        $rows = Generation::live()
            ->whereRaw('coalesce(started_at, created_at) < ?', [$cutoff])
            ->orderBy('id')
            ->get();

        // Every id pass 1 so much as looked at this run -- cancelled, found
        // already terminal, or skipped busy -- is excluded from pass 2 below.
        // A give-up is retried on the NEXT sweep, never seconds after it
        // happened in this one.
        $touched = [];

        foreach ($rows as $generation) {
            $touched[] = $generation->id;
            $lock = Cache::lock($generation->lockKey(), 180);

            try {
                // Blocking, unlike a poll: the sweep has nothing better to do
                // and a run mid-advance is worth waiting five seconds for.
                $lock->block(5);
            } catch (LockTimeoutException) {
                $this->warn("Generation {$generation->id} is busy; skipped.");

                continue;
            }

            try {
                // The poll that held the lock may have finished the run while
                // we waited.
                $generation->refresh();

                if ($generation->isTerminal()) {
                    continue;
                }

                $teardown->run($generation);
                $generation->markTerminal(GenerationStatus::Cancelled, GenerationMessages::TIMED_OUT);
                $cancelled++;
            } finally {
                $lock->release();
            }
        }

        // Second pass -- give-ups. SessionTeardown keeps the file ids it could
        // not delete and leaves archived_at null when the session was still
        // running or the archive failed; a terminal row in that state is
        // retried while attempts remain, so an abandoned session stops billing
        // and no upload outlives its run.
        //
        // Only rows whose owner still has a key: every step of the teardown
        // needs one, so a keyless row's retry would burn an attempt without
        // making a single call. The ciphertext column is non-null exactly when
        // a key exists.
        $retried = 0;
        $leftovers = Generation::query()
            ->whereIn('status', GenerationStatus::terminal())
            ->where('teardown_attempts', '<', 5)
            ->where(fn ($q) => $q
                ->whereNotNull('file_ids')
                ->orWhere(fn ($q) => $q->whereNotNull('session_id')->whereNull('archived_at')))
            ->whereHas('user.integration', fn ($q) => $q->whereNotNull('anthropic_api_key'))
            ->whereNotIn('id', $touched)
            ->orderBy('id')
            ->get();

        foreach ($leftovers as $generation) {
            $lock = Cache::lock($generation->lockKey(), 180);

            try {
                $lock->block(5);
            } catch (LockTimeoutException) {
                $this->warn("Generation {$generation->id} is busy; skipped.");

                continue;
            }

            try {
                $generation->refresh();

                // A poll or a cancel may have finished the job while we waited
                // for the lock. Re-reading the predicate on the committed row
                // keeps the count honest and saves the row an attempt.
                if (! $this->hasLeftovers($generation)) {
                    continue;
                }

                $teardown->run($generation);
                $retried++;
            } finally {
                $lock->release();
            }
        }

        $this->info("Cancelled {$cancelled} generation(s); retried {$retried} teardown(s).");

        return self::SUCCESS;
    }

    /** Anything SessionTeardown left behind: undeleted uploads, or a session it never archived. */
    private function hasLeftovers(Generation $generation): bool
    {
        return $generation->file_ids !== null
            || ($generation->session_id !== null && $generation->archived_at === null);
    }
}
