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
 */
class SessionTeardown
{
    public function __construct(
        private readonly AnthropicGateway $gateway,
        private readonly Sleeper $sleeper,
    ) {}

    public function run(Generation $generation): void
    {
        $key = $generation->user->integration?->apiKey();

        if ($key !== null && $generation->session_id !== null) {
            $this->closeSession($key, $generation);
        }

        if ($key !== null) {
            foreach ((array) ($generation->file_ids ?? []) as $fileId) {
                try {
                    $this->gateway->deleteFile($key, (string) $fileId);
                } catch (Throwable $e) {
                    Log::warning('Could not delete an Anthropic file', [
                        'generation_id' => $generation->id,
                        'file_id' => $fileId,
                        'error' => $e->getMessage(),
                    ]);
                }
            }
        }

        // Cleared either way: with no key those ids are unreachable for ever,
        // and keeping them would only make a later teardown try again.
        $generation->forceFill(['file_ids' => null])->save();
    }

    private function closeSession(string $key, Generation $generation): void
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

            return;
        }

        try {
            $this->gateway->archiveSession($key, $sessionId);
        } catch (Throwable $e) {
            Log::warning('Could not archive an Anthropic session', [
                'generation_id' => $generation->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
