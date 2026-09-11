<?php

namespace App\Http\Controllers\Api;

use App\Enums\ConnectionStatus;
use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Connection;
use App\Models\User;
use App\Notifications\ConnectionAccepted;
use App\Notifications\ConnectionRequested;
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
            ->filter(fn (Connection $c) => $c->counterpart($me)->isActive())
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
            ->get()
            ->filter(fn (Connection $c) => $c->counterpart($me)->isActive());

        return response()->json([
            'incoming' => $rows->where('addressee_id', $me->id)
                ->map(fn (Connection $c) => ['id' => $c->id, 'user' => UserSummary::for($c->requester)])
                ->values(),
            'outgoing' => $rows->where('requester_id', $me->id)
                ->map(fn (Connection $c) => ['id' => $c->id, 'user' => $this->outgoingSummary($c->addressee)])
                ->values(),
        ]);
    }

    /**
     * The counterpart of an OUTGOING pending request.
     *
     * Decision 5: a student's identity is revealed to an ACCEPTED connection,
     * and a pending request is not one. Sending a request is unilateral, so a
     * full summary here let any teacher harvest the whole student roster --
     * the exact list GET /api/users/{student} 404s to protect -- by POSTing
     * over the id space and reading this endpoint once.
     *
     * The incoming direction is deliberately untouched: an addressee has to
     * know who is asking in order to decide.
     *
     * @return array<string, mixed>
     */
    private function outgoingSummary(User $user): array
    {
        if ($user->role === Role::Student) {
            return ['id' => $user->id];
        }

        return UserSummary::for($user);
    }

    public function store(Request $request, User $user): Response
    {
        $me = $request->user();

        if ($user->id === $me->id) {
            throw ValidationException::withMessages(['user' => __('You cannot connect with yourself.')]);
        }

        // Before the role branch, or that branch becomes the oracle instead:
        // a deactivated account must answer exactly as a nonexistent id.
        // A 204 here also created a pending row that pending() filters out,
        // leaving the requester with a row they can neither see nor cancel
        // while every retry answers 422 "already exists".
        abort_unless($user->isActive(), 404);

        // 404, not the 422 the spec's endpoint table asks for. That table
        // predates the enumeration lesson this branch learned twice (9ab122a,
        // then 7b46f1c when the first fix closed the status and left the leak
        // in the body); decision 5's "404, never 403" is the higher authority
        // and the table is downstream of it. A 422 naming the reason let a
        // student walk the id space and rebuild the student directory the
        // spec deliberately omits. Nothing is lost: students cannot discover
        // other students, so the only way to reach this branch is the attack.
        abort_if($me->role === Role::Student && $user->role === Role::Student, 404);

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

        $user->notify(new ConnectionRequested($me));

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

        $connection->requester->notify(new ConnectionAccepted($me));

        return response()->noContent();
    }

    public function destroy(Request $request, Connection $connection): Response
    {
        abort_unless($connection->involves($request->user()), 404);

        $connection->delete();

        return response()->noContent();
    }
}
