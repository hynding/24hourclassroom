<?php

namespace App\Support;

use App\Models\Integration;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * The GET /integrations body. Plan 1 hard-coded the `anthropic` block because
 * the integrations table did not exist yet; it is now read from the row.
 */
final class IntegrationsPayload
{
    /** @return array<string, mixed> */
    public static function for(User $user): array
    {
        $integration = Integration::forUser($user);

        // hasKey() FIRST: on an APP_KEY rotation it clears the hint and the
        // verified stamp on this very instance, and the block below must
        // report the cleared values, not the stale ones.
        $configured = $integration->hasKey();

        return [
            'mcp_tokens' => $user->tokens()->latest('id')->get()
                ->map(fn (PersonalAccessToken $token) => McpTokenPayload::for($token))
                ->values()
                ->all(),
            'anthropic' => [
                'configured' => $configured,
                'hint' => $integration->anthropic_key_hint,
                'verified_at' => $integration->anthropic_key_verified_at,
            ],
        ];
    }
}
