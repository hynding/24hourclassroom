<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

/**
 * Alias `token-only`. auth:sanctum falls back to the session guard, which
 * hands a browser-authenticated request a TransientToken whose can() is
 * unconditionally true -- so `abilities:mcp` alone does not keep a logged-in
 * tab out of the MCP route. (In Pest, actingAs() produces exactly that
 * token.) Only a real PersonalAccessToken passes.
 */
class RejectTransientToken
{
    public function handle(Request $request, Closure $next): Response
    {
        abort_unless(
            $request->user()?->currentAccessToken() instanceof PersonalAccessToken,
            401,
            'This endpoint accepts a personal access token only.'
        );

        return $next($request);
    }
}
