<?php

namespace App\Support;

use App\Enums\Role;
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
            // An avatar only for a teacher. Decision 5 says an accepted
            // connection sees a student NAME ONLY, and PublicProfileController
            // honours that literally -- it omits the `profile` key altogether.
            // This helper disagreed, so the same accepted student came back as
            // {id,name,role} from /api/users/{id} and {id,name,role,
            // avatar_url} from /api/connections.
            //
            // Written as an allowlist rather than `=== Role::Student`: a
            // denylist over an open enum breaks every time the enum grows, and
            // this one grew inside this very milestone. A teacher is the only
            // role that is publicly discoverable (GET /api/teachers), so a
            // teacher is the only role whose avatar travels. The key stays
            // (@24hc/shared declares `string | null`) so the payload's shape
            // does not itself announce the role.
            'avatar_url' => $user->role === Role::Teacher ? $user->profile?->avatar_url : null,
        ];
    }
}
