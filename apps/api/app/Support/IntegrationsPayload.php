<?php

namespace App\Support;

use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * The GET /integrations body.
 *
 * PLAN 1 ONLY for the `anthropic` block: the `integrations` table arrives
 * with plan 2, which replaces these three hard-coded values with
 * Integration::forUser($user) (configured = hasKey(), hint =
 * anthropic_key_hint, verified_at = anthropic_key_verified_at) and rewrites
 * plan 1's assertion in McpTokenTest. The KEYS are final, so the SPA
 * contract and @24hc/shared's Integrations interface do not move.
 */
final class IntegrationsPayload
{
    /** @return array<string, mixed> */
    public static function for(User $user): array
    {
        return [
            'mcp_tokens' => $user->tokens()
                ->latest('id')
                ->get()
                ->map(fn (PersonalAccessToken $token) => McpTokenPayload::for($token))
                ->all(),
            'anthropic' => ['configured' => false, 'hint' => null, 'verified_at' => null],
        ];
    }
}
