<?php

namespace App\Mcp\Tools\Concerns;

use App\Enums\Role;
use App\Models\User;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;

/**
 * The in-tool allowlist. The route's `teacher` middleware answers 403 for a
 * transport request, but the documented test harness calls handle()
 * directly, so every tool checks again in the package's own error model.
 * Allowlist, never `!== Student`: a fourth role is refused by default.
 */
trait TeachersOnly
{
    protected function teacherOr(Request $request): User|Response
    {
        $user = $request->user();

        return ($user instanceof User && $user->role === Role::Teacher)
            ? $user
            : Response::error('Only teachers can use this server.');
    }
}
