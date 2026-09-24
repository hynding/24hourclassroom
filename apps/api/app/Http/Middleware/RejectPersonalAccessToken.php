<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

/**
 * Alias `session-only`. A personal access token is valid at the MCP route
 * and nowhere else: auth:sanctum would otherwise accept an `mcp` token on
 * every JSON endpoint it guards. 401, not 403 -- the credential is not
 * accepted here at all, and ApiClient.currentUser() maps 401 to null while
 * any other status throws out of the SPA's boot path.
 */
class RejectPersonalAccessToken
{
    public function handle(Request $request, Closure $next): Response
    {
        abort_if(
            $request->user()?->currentAccessToken() instanceof PersonalAccessToken,
            401,
            'Personal access tokens are only valid at the MCP endpoint.'
        );

        return $next($request);
    }
}
