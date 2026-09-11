<?php

namespace App\Http\Controllers\Api;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\User;
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
        Follow::firstOrCreate([
            'follower_id' => $request->user()->id,
            'followed_id' => $user->id,
        ]);

        return response()->noContent();
    }

    public function destroy(Request $request, User $user): Response
    {
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
        abort_unless($user->role === Role::Teacher, 404);
    }
}
