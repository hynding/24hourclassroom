<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Connection;
use App\Models\Follow;
use App\Support\AdminMetrics;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * Removing a follow or a connection is not a state change on an account,
 * so there is no target allowlist here: the admin middleware is the guard,
 * and a relationship involving an admin account may be removed too. Both
 * removals are silent to both parties -- a removed connection frees the
 * pair key, so this is a remedy for a mistaken relationship; for
 * harassment the remedy is deactivation.
 */
class RelationshipAdminController extends Controller
{
    public function removeFollow(Request $request, Follow $follow): RedirectResponse
    {
        $follow->delete();

        Log::info('Admin removed a follow', ['admin_id' => $request->user()->id, 'follower_id' => $follow->follower_id, 'followed_id' => $follow->followed_id]);
        Cache::forget(AdminMetrics::CACHE_KEY);

        return back();
    }

    /** Byte-identical to the party's own decline/cancel/disconnect (ConnectionController::destroy): a bare delete, no notification. */
    public function removeConnection(Request $request, Connection $connection): RedirectResponse
    {
        $connection->delete();

        Log::info('Admin removed a connection', ['admin_id' => $request->user()->id, 'requester_id' => $connection->requester_id, 'addressee_id' => $connection->addressee_id, 'status' => $connection->status->value]);
        Cache::forget(AdminMetrics::CACHE_KEY);

        return back();
    }
}
