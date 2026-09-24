<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class McpTokenController extends Controller
{
    /**
     * Five live tokens per teacher: enough for a laptop, a desktop and a
     * spare, few enough that a leaked list is small. The role gate is the
     * route's `teacher` middleware.
     */
    private const MAX_TOKENS = 5;

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:60']]);
        $user = $request->user();

        if ($user->tokens()->count() >= self::MAX_TOKENS) {
            // 422 on `name` rather than a bare message: the SPA renders it
            // under the only field the form has.
            throw ValidationException::withMessages(['name' => ['Revoke a token first.']]);
        }

        // ['mcp'] and no expiry (decision 2): revocable, never expiring.
        $token = $user->createToken($data['name'], ['mcp']);

        // The plaintext exists here and nowhere else, ever again.
        return response()->json([
            'id' => $token->accessToken->id,
            'name' => $token->accessToken->name,
            'token' => $token->plainTextToken,
        ], 201);
    }

    /**
     * No route-model binding and no Route::pattern: `{id}` is taken as a
     * string, so it needs its own digits-only guard before the lookup. A
     * bare `(int)` cast would turn a numeric-prefixed segment like `12abc`
     * into `12` and delete that token instead of 404ing, so a non-digit
     * segment is rejected up front rather than cast.
     */
    public function destroy(Request $request, string $id): Response
    {
        $token = ctype_digit($id)
            ? $request->user()->tokens()->whereKey((int) $id)->first()
            : null;

        abort_if($token === null, 404);

        $token->delete();

        return response()->noContent();
    }
}
