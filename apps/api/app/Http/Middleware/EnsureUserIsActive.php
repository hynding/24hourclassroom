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
            $request->session()->invalidate();
            $request->session()->regenerateToken();

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
