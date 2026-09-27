<?php

namespace App\Console\Commands;

use App\Ai\CancelOutcome;
use App\Ai\GenerationCanceller;
use App\Ai\TeardownOutcome;
use App\Models\Generation;
use App\Support\GenerationMessages;
use Illuminate\Console\Command;

class SweepGenerations extends Command
{
    protected $signature = 'generations:sweep';

    protected $description = 'Cancel generations that have been running longer than generation.max_run_minutes';

    public function handle(GenerationCanceller $canceller): int
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

            // Blocking, unlike a poll: the sweep has nothing better to do and a
            // run mid-advance is worth waiting five seconds for. The canceller
            // re-reads the row under the lock, so a poll that finished the run
            // while we waited comes back AlreadyTerminal and is left alone.
            match ($canceller->cancel($generation, GenerationMessages::TIMED_OUT)) {
                CancelOutcome::Cancelled => $cancelled++,
                CancelOutcome::Busy => $this->warn("Generation {$generation->id} is busy; skipped."),
                CancelOutcome::AlreadyTerminal => null,
            };
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
        $leftovers = Generation::withLeftovers()
            ->where('teardown_attempts', '<', 5)
            ->whereHas('user.integration', fn ($q) => $q->whereNotNull('anthropic_api_key'))
            ->whereNotIn('id', $touched)
            ->orderBy('id')
            ->get();

        foreach ($leftovers as $generation) {
            // NothingToDo: a poll or a cancel finished the cleanup while we
            // waited for the lock. The re-read under the lock keeps the count
            // honest and saves the row an attempt.
            match ($canceller->retryTeardown($generation)) {
                TeardownOutcome::Ran => $retried++,
                TeardownOutcome::Busy => $this->warn("Generation {$generation->id} is busy; skipped."),
                TeardownOutcome::NothingToDo => null,
            };
        }

        $this->info("Cancelled {$cancelled} generation(s); retried {$retried} teardown(s).");

        return self::SUCCESS;
    }
}
