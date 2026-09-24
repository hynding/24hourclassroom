<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Alias `teacher`. An allowlist, exactly like EnsureUserIsAdmin: a fourth
 * role added to the enum is refused by default.
 */
class EnsureUserIsTeacher
{
    public function handle(Request $request, Closure $next): Response
    {
        abort_unless($request->user()?->role === Role::Teacher, 403);

        return $next($request);
    }
}
