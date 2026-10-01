<?php

namespace App\Ai;

use App\Models\Integration;
use App\Models\User;

/**
 * The teacher's own DELETE /integrations/anthropic-key and the admin's
 * clear-key share this. Verbatim from AnthropicKeyController::destroy:
 * teardown, then re-read the row (the teardown cleared provisioning on its
 * own instance; writing through a stale one would put the ids back), then
 * null the key columns. No clearProvisioning() here -- the teardown does
 * it; update()'s extra call exists only because it writes a new key after.
 */
final class AnthropicKeyRemover
{
    public function __construct(private readonly IntegrationTeardown $teardown) {}

    /** @return array{cancelled: int, skipped: int} */
    public function forUser(User $user): array
    {
        $result = $this->teardown->forUser($user);

        Integration::forUser($user)->forceFill([
            'anthropic_api_key' => null,
            'anthropic_key_hint' => null,
            'anthropic_key_verified_at' => null,
        ])->save();

        return $result;
    }
}
