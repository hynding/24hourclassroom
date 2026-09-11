<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotificationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        // reorder(): the notifiable relation's default `latest()` sorts only
        // by created_at, which MySQL stores at whole-second precision no
        // matter the column's declared precision. Two notifications created
        // within the same second -- routine, not an edge case -- would tie
        // and then sort by the random `id` UUID, i.e. arbitrarily. `sequence`
        // is a monotonic auto-increment column added for exactly this.
        return response()->json(
            $request->user()->notifications()->reorder('sequence', 'desc')->paginate(15)
        );
    }

    public function unreadCount(Request $request): JsonResponse
    {
        return response()->json(['count' => $request->user()->unreadNotifications()->count()]);
    }

    public function read(Request $request): Response
    {
        $validated = $request->validate([
            'ids' => ['nullable', 'array'],
            'ids.*' => ['string'],
        ]);

        // Always scoped to the caller's own notifications. Ids belonging to
        // anyone else simply match nothing -- no 403, no 404, so the endpoint
        // cannot be used to probe whether an id exists.
        $query = $request->user()->unreadNotifications();

        if (! empty($validated['ids'])) {
            $query->whereIn('id', $validated['ids']);
        }

        $query->update(['read_at' => now()]);

        return response()->noContent();
    }
}
