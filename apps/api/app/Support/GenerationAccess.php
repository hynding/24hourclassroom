<?php

namespace App\Support;

use App\Models\Generation;
use App\Models\User;

/**
 * Ownership only, and 404 rather than 403: a generation belonging to another
 * teacher and a generation that does not exist are indistinguishable, the same
 * rule tests, materials and profiles follow.
 */
final class GenerationAccess
{
    public static function assertOwner(?User $user, Generation $generation): void
    {
        abort_unless($user !== null && $user->id === $generation->user_id, 404);
    }
}
