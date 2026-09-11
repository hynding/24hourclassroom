<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotificationController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        // reorder(): the notifiable relation's default `latest()` sorts only
        // by created_at, which MySQL stores at whole-second precision no
        // matter the column's declared precision. Two notifications created
        // within the same second -- routine, not an edge case -- would tie
        // and then sort by the random `id` UUID, i.e. arbitrarily. `sequence`
        // is a monotonic auto-increment column added for exactly this.
        // A Resource collection, not response()->json($paginator): the latter
        // serialises flat, and the SPA reads `meta.last_page` like it does on
        // every other paginated endpoint.
        return NotificationResource::collection(
            $this->visible($request->user()->notifications())->reorder('sequence', 'desc')->paginate(15)
        );
    }

    public function unreadCount(Request $request): JsonResponse
    {
        // Filtered the same way as index(): a badge counting rows the list
        // will not show is a badge that never clears.
        return response()->json([
            'count' => $this->visible($request->user()->unreadNotifications())->count(),
        ]);
    }

    /**
     * Hide notifications whose actor the viewer may no longer see.
     *
     * UserSummary is snapshotted into `data` when the notification is sent
     * and never revisited, so a declined requester's name survived their
     * deactivation -- the one place the "deactivated is indistinguishable
     * from nonexistent" rule did not hold, while /api/users/{id} 404s them
     * and every other list endpoint filters them out (spec lines 59-60).
     *
     * Applied at READ time rather than write time on purpose: the data was
     * legitimately captured, and what changed is who may see it now. Rows
     * are hidden, not deleted, so a reactivation restores them along with
     * the rest of the graph (decision 4).
     *
     * Rows with no actor at all -- ProfileModerated carries only a message
     * -- must pass through, hence the null branch.
     *
     * @param  MorphMany<\Illuminate\Notifications\DatabaseNotification, User>  $query
     * @return MorphMany<\Illuminate\Notifications\DatabaseNotification, User>
     */
    private function visible(MorphMany $query): MorphMany
    {
        return $query->where(function ($q) {
            $q->whereNull('data->user->id')
                ->orWhereIn('data->user->id', User::query()->whereNull('deactivated_at')->select('id'));
        });
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
