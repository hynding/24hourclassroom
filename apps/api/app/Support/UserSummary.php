<?php

namespace App\Support;

use App\Models\User;

final class UserSummary
{
    /**
     * The person-shaped payload every relation list and notification shares.
     * Deliberately an explicit allowlist -- `email` is NOT in User::$hidden,
     * so building this from toArray() would leak it.
     *
     * @return array<string, mixed>
     */
    public static function for(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'role' => $user->role,
            'avatar_url' => $user->profile?->avatar_url,
        ];
    }
}
