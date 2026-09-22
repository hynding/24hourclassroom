<?php

use App\Mcp\Servers\TeacherServer;
use Laravel\Mcp\Facades\Mcp;

/*
|--------------------------------------------------------------------------
| MCP servers
|--------------------------------------------------------------------------
|
| This file is loaded by laravel/mcp's own provider with Route::group([],
| $path) -- no middleware group and no prefix. So the URL is /mcp/teacher on
| the API host (NOT /api/mcp/teacher), and none of the api group's session
| middleware runs here. Do not add this file to withRouting() as well.
|
| The seven middlewares are declared in the order below, but that is not the
| order they RUN in: the framework's priority list moves ThrottleRequests
| ahead of the aliased gates, so the resolved order is auth:sanctum ->
| token-only -> abilities:mcp -> verified -> throttle:mcp -> active ->
| teacher. A request rejected before the throttle runs (401/403 from auth or
| the ability check) is never rate-limited -- the same shape as the
| existing unthrottled login route.
|   auth:sanctum   401 for no credential at all
|   token-only     401 for a session (auth:sanctum falls back to the session
|                  guard and hands it a TransientToken that can() anything)
|   abilities:mcp  403 for a token minted for something else
|   verified       403 for an unverified address
|   active         401 for a deactivated account (ahead of `teacher` in the
|                  priority list, so it wins)
|   teacher        403 for any other role -- allowlist
|   throttle:mcp   60/min keyed on the token id, its own bucket
|
| The package adds ReorderJsonAccept, ValidateMcpHeaders and
| AddWwwAuthenticateHeader itself, and registers GET/DELETE 405 closures on
| the same URI.
*/

Mcp::web('/mcp/teacher', TeacherServer::class)
    ->middleware(['auth:sanctum', 'token-only', 'abilities:mcp', 'verified', 'active', 'teacher', 'throttle:mcp']);
