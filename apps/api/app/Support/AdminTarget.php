<?php

namespace App\Support;

use App\Enums\Role;
use App\Models\User;

/**
 * Who an admin may act on. An allowlist, not `!== Admin` (CLAUDE.md, the
 * recurring defect class): a fourth role is refused by default. Admin
 * accounts are provisioned and demoted from the shell (user:promote,
 * user:demote), so a stolen admin session cannot remove or silence another
 * admin. The self clause is defence in depth -- the actor is always an
 * admin, so the allowlist already excludes them.
 */
final class AdminTarget
{
    public static function isActionable(User $actor, User $target): bool
    {
        return $target->id !== $actor->id
            && in_array($target->role, [Role::Teacher, Role::Student], true);
    }

    public static function assertActionable(User $actor, User $target): void
    {
        abort_if(! self::isActionable($actor, $target), 403);
    }
}
