<?php

namespace App\Http\Controllers\Api;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\ProfilePayload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    public function __invoke(Request $request, User $user): JsonResponse
    {
        // Students are not publicly viewable in B1. 404, never 403 — a 403 would confirm the account exists.
        abort_unless($user->role === Role::Teacher, 404);

        $user->load('profile');

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'role' => $user->role,
            'profile' => ProfilePayload::for($user->profile),
        ]);
    }
}
