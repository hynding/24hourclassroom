<?php

namespace App\Support;

use Laravel\Sanctum\PersonalAccessToken;

/**
 * The one MCP-token row shape. Deliberately four keys: `token` (the
 * plaintext) exists only in the 201 from the mint, and `abilities` and the
 * hash are never sent anywhere.
 */
final class McpTokenPayload
{
    /** @return array<string, mixed> */
    public static function for(PersonalAccessToken $token): array
    {
        return [
            'id' => $token->id,
            'name' => $token->name,
            'last_used_at' => $token->last_used_at,
            'created_at' => $token->created_at,
        ];
    }
}
