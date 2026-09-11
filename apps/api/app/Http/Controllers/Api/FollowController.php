<?php

namespace App\Http\Controllers\Api;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\User;
use App\Notifications\NewFollower;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class FollowController extends Controller
{
    public function store(Request $request, User $user): Response
    {
        $this->guard($request, $user);

        // firstOrCreate rather than create: a double-tap is a duplicate click,
        // not an error worth showing anyone.
        $follow = Follow::firstOrCreate([
            'follower_id' => $request->user()->id,
            'followed_id' => $user->id,
        ]);

        if ($follow->wasRecentlyCreated) {
            $user->notify(new NewFollower($request->user()));
        }

        return response()->noContent();
    }

    public function destroy(Request $request, User $user): Response
    {
        // The same guard store() carries. Without it, 204-for-anything vs
        // 404-for-nonexistent made this a complete user-table census.
        $this->guard($request, $user);

        Follow::where('follower_id', $request->user()->id)
            ->where('followed_id', $user->id)
            ->delete();

        return response()->noContent();
    }

    private function guard(Request $request, User $user): void
    {
        if ($user->id === $request->user()->id) {
            throw ValidationException::withMessages(['user' => __('You cannot follow yourself.')]);
        }

        // 404, never a validation error — a distinguishable status would let an
        // authenticated user classify ids as "real student" vs "nonexistent".
        // Matches PublicProfileController's existence-oracle guard exactly.
        //
        // isActive() is part of the same rule, not an extra: a deactivated
        // account whose profile 404s and who is absent from the directory must
        // not be confirmed by a 204 here -- and must not receive a NewFollower
        // notification on an account the platform claims is gone.
        abort_unless($user->role === Role::Teacher && $user->isActive(), 404);
    }
}
