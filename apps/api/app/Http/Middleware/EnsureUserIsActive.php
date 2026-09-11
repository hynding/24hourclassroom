<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && ! $user->isActive()) {
            Auth::guard('web')->logout();

            // hasSession(): $request->session() throws when no session was
            // started, which would turn this 401 into a hard 500 -- the exact
            // status the 401 exists to avoid, since anything but 401 rejects
            // inside the SPA's connectedCallback and takes down the shell.
            // Unreachable today (Sanctum only authenticates /api/* once the
            // stateful-frontend middleware has started a session, and User has
            // no HasApiTokens), but it goes live the day token auth is added
            // or a route moves off the stateful group. The refusal below is
            // unconditional either way.
            if ($request->hasSession()) {
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }

            // 401, not 403: the session was just destroyed, so the request IS
            // unauthenticated -- and ApiClient.currentUser() maps 401 to null
            // while any other status throws out of the SPA's boot path.
            if ($request->expectsJson()) {
                abort(401, 'Your account has been deactivated.');
            }

            return redirect()->guest(route('login'));
        }

        return $next($request);
    }
}
