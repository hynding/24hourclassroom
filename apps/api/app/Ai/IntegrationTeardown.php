<?php

namespace App\Ai;

use App\Enums\GenerationStatus;
use App\Models\Integration;
use App\Models\User;
use App\Support\GenerationMessages;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Everything the teacher's Anthropic organisation is holding for us, released
 * under the CURRENT key: called by DELETE /integrations/anthropic-key, by the
 * replace half of PUT (before the new key is stored) and by account deletion.
 *
 * It deliberately does NOT clear the key itself -- the caller decides whether
 * a new one is going in.
 */
class IntegrationTeardown
{
    public function __construct(
        private readonly AnthropicGateway $gateway,
        private readonly SessionTeardown $sessions,
    ) {}

    public function forUser(User $user): void
    {
        foreach ($user->generations()->live()->get() as $generation) {
            // The same lock the advancer and cancel take, so a poll in flight
            // cannot be advancing the run we are tearing down.
            $lock = Cache::lock($generation->lockKey(), 180);

            try {
                $lock->block(5);
            } catch (LockTimeoutException) {
                Log::warning('Skipped a busy generation during an integration teardown', [
                    'generation_id' => $generation->id,
                ]);

                continue;
            }

            try {
                $this->sessions->run($generation);
                $generation->markTerminal(GenerationStatus::Cancelled, GenerationMessages::KEY_REMOVED);
            } finally {
                $lock->release();
            }
        }

        $integration = Integration::forUser($user);
        $key = $integration->apiKey();

        if ($key !== null) {
            $this->archive(
                $integration->anthropic_agent_id,
                fn (string $id) => $this->gateway->archiveAgent($key, $id),
            );
            $this->archive(
                $integration->anthropic_environment_id,
                fn (string $id) => $this->gateway->archiveEnvironment($key, $id),
            );
        }

        $integration->clearProvisioning();
    }

    private function archive(?string $id, callable $call): void
    {
        if ($id === null) {
            return;
        }

        try {
            $call($id);
        } catch (Throwable $e) {
            Log::warning('Could not archive an Anthropic resource', [
                'id' => $id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
