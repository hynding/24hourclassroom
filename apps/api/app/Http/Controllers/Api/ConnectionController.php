<?php

namespace App\Http\Controllers\Api;

use App\Enums\ConnectionStatus;
use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Connection;
use App\Models\User;
use App\Support\UserSummary;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ConnectionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $me = $request->user();

        $rows = Connection::with(['requester.profile', 'addressee.profile'])
            ->where('status', ConnectionStatus::Accepted)
            ->where(fn ($q) => $q->where('requester_id', $me->id)->orWhere('addressee_id', $me->id))
            ->get()
            ->map(fn (Connection $c) => [
                'id' => $c->id,
                'user' => UserSummary::for($c->counterpart($me)),
            ])
            ->values();

        return response()->json(['data' => $rows]);
    }

    public function pending(Request $request): JsonResponse
    {
        $me = $request->user();

        $rows = Connection::with(['requester.profile', 'addressee.profile'])
            ->where('status', ConnectionStatus::Pending)
            ->where(fn ($q) => $q->where('requester_id', $me->id)->orWhere('addressee_id', $me->id))
            ->get();

        return response()->json([
            'incoming' => $rows->where('addressee_id', $me->id)
                ->map(fn (Connection $c) => ['id' => $c->id, 'user' => UserSummary::for($c->requester)])
                ->values(),
            'outgoing' => $rows->where('requester_id', $me->id)
                ->map(fn (Connection $c) => ['id' => $c->id, 'user' => UserSummary::for($c->addressee)])
                ->values(),
        ]);
    }

    public function store(Request $request, User $user): Response
    {
        $me = $request->user();

        if ($user->id === $me->id) {
            throw ValidationException::withMessages(['user' => __('You cannot connect with yourself.')]);
        }

        if ($me->role === Role::Student && $user->role === Role::Student) {
            throw ValidationException::withMessages(['user' => __('Students cannot connect with each other.')]);
        }

        try {
            Connection::create([
                'requester_id' => $me->id,
                'addressee_id' => $user->id,
                'status' => ConnectionStatus::Pending,
                'pair_key' => Connection::pairKey($me->id, $user->id),
            ]);
        } catch (QueryException) {
            // The unique pair_key index caught either a duplicate request or a
            // simultaneous one from the other direction. Both are the same
            // thing to the user.
            throw ValidationException::withMessages(['user' => __('A connection with this person already exists.')]);
        }

        return response()->noContent();
    }

    public function update(Request $request, Connection $connection): Response
    {
        $me = $request->user();

        // 404 for strangers so a connection's existence cannot be probed;
        // 403 for the requester, who is a party and already knows.
        abort_unless($connection->involves($me), 404);
        abort_if($connection->requester_id === $me->id, 403);

        $connection->update(['status' => ConnectionStatus::Accepted]);

        return response()->noContent();
    }

    public function destroy(Request $request, Connection $connection): Response
    {
        abort_unless($connection->involves($request->user()), 404);

        $connection->delete();

        return response()->noContent();
    }
}
