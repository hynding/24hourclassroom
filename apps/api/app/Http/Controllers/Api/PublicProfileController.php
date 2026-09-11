<?php

namespace App\Http\Controllers\Api;

use App\Enums\ConnectionStatus;
use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Connection;
use App\Models\Follow;
use App\Models\User;
use App\Support\ProfilePayload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    public function __invoke(Request $request, User $user): JsonResponse
    {
        // Deactivated users are indistinguishable from students and from ids
        // that never existed. 404, never 403 -- a 403 confirms the account.
        abort_unless($user->isActive(), 404);

        $viewer = $request->user();

        // An allowlist, not a denylist. This used to read
        // `if (role === Student) { restricted } else { public }`, so the day
        // Role::Admin was added it fell straight into the public branch and
        // an anonymous visitor could read a named administrator's bio. A
        // denylist over an open enum breaks every time the enum grows; only
        // teachers are public figures here.
        if ($user->role !== Role::Teacher) {
            abort_unless($viewer && $this->hasAcceptedConnection($viewer, $user), 404);

            // Name only. No profile key at all -- an empty profile object
            // would still tell the viewer the shape of what they cannot see.
            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'role' => $user->role,
            ]);
        }

        $user->load('profile');

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'role' => $user->role,
            'profile' => ProfilePayload::for($user->profile),
            'is_following' => $viewer ? $this->isFollowing($viewer, $user) : null,
            'connection' => $viewer ? $this->connectionState($viewer, $user) : null,
        ]);
    }

    private function isFollowing(User $viewer, User $user): bool
    {
        return Follow::where('follower_id', $viewer->id)->where('followed_id', $user->id)->exists();
    }

    /** @return array<string, mixed>|null */
    private function connectionState(User $viewer, User $user): ?array
    {
        $connection = Connection::where('pair_key', Connection::pairKey($viewer->id, $user->id))->first();

        if (! $connection) {
            return null;
        }

        return [
            'id' => $connection->id,
            'status' => $connection->status->value,
            'direction' => $connection->requester_id === $viewer->id ? 'outgoing' : 'incoming',
        ];
    }

    private function hasAcceptedConnection(User $viewer, User $user): bool
    {
        return Connection::where('pair_key', Connection::pairKey($viewer->id, $user->id))
            ->where('status', ConnectionStatus::Accepted)
            ->exists();
    }
}
