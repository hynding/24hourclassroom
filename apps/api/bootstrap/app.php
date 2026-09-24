<?php

use App\Http\Middleware\HandleAppearance;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->statefulApi();

        $middleware->encryptCookies(except: ['appearance', 'sidebar_state']);

        $middleware->web(append: [
            HandleAppearance::class,
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
        ]);

        $middleware->alias([
            'active' => App\Http\Middleware\EnsureUserIsActive::class,
            'admin' => App\Http\Middleware\EnsureUserIsAdmin::class,
            'teacher' => App\Http\Middleware\EnsureUserIsTeacher::class,
            // A personal access token is valid at /mcp/teacher and nowhere
            // else; a session is valid everywhere else and not there.
            'session-only' => App\Http\Middleware\RejectPersonalAccessToken::class,
            'token-only' => App\Http\Middleware\RejectTransientToken::class,
            // Sanctum's own ability check: 401 without a token, 403 when the
            // ability is missing.
            'abilities' => Laravel\Sanctum\Http\Middleware\CheckAbilities::class,
        ]);

        // SubstituteBindings is in the framework's priority list; a custom
        // alias is not, so an authorization alias runs AFTER route-model
        // binding unless it is added here. That made /admin/users/{user}/*
        // an existence oracle (404 for a missing id, 403 for a real one --
        // the non-member got the MORE informative status), and it would do
        // the same to /generations/{generation} for a student. Authorization
        // gates belong in front of the binding they guard.
        //
        // The four calls are CHAINED (teacher before SubstituteBindings,
        // admin before teacher, active before admin, session-only before
        // active) rather than each pointing at SubstituteBindings, because
        // prependToPriorityList() stores its argument in an array keyed on
        // the middleware being inserted: two calls prepending
        // EnsureUserIsActive would overwrite each other and the surviving
        // one would be applied before EnsureUserIsTeacher had been inserted,
        // which appends `active` to the END of the priority list -- behind
        // SubstituteBindings -- and silently undoes the `active` ahead of
        // `admin` guarantee below.
        //
        // `active` is second -- right behind `session-only` -- so it still
        // wins over every gate that follows it: a deactivated non-admin is
        // redirected to login rather than told 403, and a deactivated
        // teacher's token gets 401 rather than 403.
        //
        // `session-only` is chained ahead of `active` for the same reason: a
        // personal access token must be refused before route-model binding
        // ever runs, or a stolen MCP token could walk every id space by
        // reading 404 (missing) vs 401 (exists) off a bound route's response.
        //
        // `verified` is chained in fifth, directly ahead of `admin`, for the
        // identical existence-oracle reason: EnsureEmailIsVerified is not in
        // the framework's default priority list at all, so without this it
        // sorted wherever the route's own middleware happened to put it --
        // in practice AFTER SubstituteBindings on a route like POST
        // /generations/{generation}/cancel, which let an unverified but
        // otherwise-authenticated teacher's request bind the model before
        // being rejected, turning a 403 into a 404-vs-403 existence oracle
        // over every generation id exactly like the admin one above.
        // Resulting order: session-only -> active -> verified -> admin ->
        // teacher -> SubstituteBindings.
        $middleware->prependToPriorityList(
            Illuminate\Routing\Middleware\SubstituteBindings::class,
            App\Http\Middleware\EnsureUserIsTeacher::class,
        );
        $middleware->prependToPriorityList(
            App\Http\Middleware\EnsureUserIsTeacher::class,
            App\Http\Middleware\EnsureUserIsAdmin::class,
        );
        $middleware->prependToPriorityList(
            App\Http\Middleware\EnsureUserIsAdmin::class,
            App\Http\Middleware\EnsureUserIsActive::class,
        );
        $middleware->prependToPriorityList(
            App\Http\Middleware\EnsureUserIsActive::class,
            App\Http\Middleware\RejectPersonalAccessToken::class,
        );
        $middleware->prependToPriorityList(
            App\Http\Middleware\EnsureUserIsAdmin::class,
            Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // A ModelNotFoundException (route-model-binding miss) and an explicit
        // abort(404) both surface as NotFoundHttpException by the time they
        // reach here, but Laravel's default message for the former embeds the
        // model class and id -- an existence oracle for any 404-guarded
        // endpoint. Normalise every JSON 404 body to one constant so a
        // missing record and a deliberately-hidden one are indistinguishable.
        // Web/Inertia 404s are untouched.
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Not found.'], 404);
            }
        });
    })->create();
