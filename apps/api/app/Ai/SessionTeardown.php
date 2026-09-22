<?php

namespace App\Ai;

use App\Models\Generation;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * The ONE way a run's Anthropic resources are released: the advancer, cancel,
 * IntegrationTeardown, the sweep and a failed create all call this. Every step
 * is best effort -- a failure is logged and the next step still runs, because
 * a stuck archive must never leave uploaded material bytes behind in the
 * teacher's organisation.
 *
 * A give-up is not final: `teardown_attempts` counts every call this makes,
 * win or lose, and `archived_at` stays null -- and any file id that could not
 * be deleted stays in `file_ids` -- until a later run actually finishes the
 * job. That is what lets the sweep (plan 3) retry a row while
 * teardown_attempts < 5 instead of leaving orphaned Anthropic resources behind
 * for ever.
 */
class SessionTeardown
{
    public function __construct(
        private readonly AnthropicGateway $gateway,
        private readonly Sleeper $sleeper,
    ) {}

    public function run(Generation $generation): void
    {
        $generation->forceFill(['teardown_attempts' => $generation->teardown_attempts + 1])->save();

        $key = $generation->user->integration?->apiKey();

        // No session ever existed -- there is nothing to archive, so this
        // counts as done. Otherwise archived_at is only set once
        // closeSession() reports the archive itself actually succeeded; a
        // session still running after five reads, or an archive call that
        // throws, leaves it null for the sweep to retry.
        if ($generation->session_id === null) {
            $generation->forceFill(['archived_at' => now()])->save();
        } elseif ($key !== null && $this->closeSession($key, $generation)) {
            $generation->forceFill(['archived_at' => now()])->save();
        }

        if ($key !== null) {
            // Only the ids that actually deleted are dropped; a failure is
            // kept, in order, so a later run tries it again instead of
            // silently abandoning bytes in the teacher's organisation.
            $remaining = [];

            foreach ((array) ($generation->file_ids ?? []) as $fileId) {
                try {
                    $this->gateway->deleteFile($key, (string) $fileId);
                } catch (Throwable $e) {
                    Log::warning('Could not delete an Anthropic file', [
                        'generation_id' => $generation->id,
                        'file_id' => $fileId,
                        'error' => $e->getMessage(),
                    ]);

                    $remaining[] = $fileId;
                }
            }

            $generation->forceFill(['file_ids' => $remaining === [] ? null : array_values($remaining)])->save();
        }

        // With no key at all the ids are left exactly as they were: nothing
        // was attempted, and a teacher who adds a new key later must still
        // find them here for a subsequent teardown to clean up.
    }

    /** @return bool Whether the session was actually archived. */
    private function closeSession(string $key, Generation $generation): bool
    {
        $sessionId = (string) $generation->session_id;

        try {
            $this->gateway->interrupt($key, $sessionId);
        } catch (Throwable $e) {
            Log::warning('Could not interrupt an Anthropic session', [
                'generation_id' => $generation->id,
                'error' => $e->getMessage(),
            ]);
        }

        // The interrupt is asynchronous and archive is rejected on a running
        // session, so poll up to five times, a second apart. A read failure
        // leaves the status unknown -- not "running" -- so archive is still
        // attempted; only five confirmed "running" answers skip it.
        $stillRunning = true;
        $listCostCents = null;

        for ($attempt = 1; $attempt <= 5; $attempt++) {
            try {
                $session = $this->gateway->retrieveSession($key, $sessionId);
            } catch (Throwable $e) {
                Log::warning('Could not read an Anthropic session', [
                    'generation_id' => $generation->id,
                    'error' => $e->getMessage(),
                ]);

                $stillRunning = false;
                break;
            }

            if ($session['listCostCents'] !== null) {
                $listCostCents = $session['listCostCents'];
            }

            if ($session['status'] !== 'running') {
                $stillRunning = false;
                break;
            }

            if ($attempt < 5) {
                $this->sleeper->sleep(1);
            }
        }

        if ($listCostCents !== null) {
            $generation->forceFill(['list_cost_cents' => $listCostCents])->save();
        }

        if ($stillRunning) {
            Log::warning('An Anthropic session was still running after the interrupt; not archiving', [
                'generation_id' => $generation->id,
                'session_id' => $sessionId,
            ]);

            return false;
        }

        try {
            $this->gateway->archiveSession($key, $sessionId);

            return true;
        } catch (Throwable $e) {
            Log::warning('Could not archive an Anthropic session', [
                'generation_id' => $generation->id,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }
}
