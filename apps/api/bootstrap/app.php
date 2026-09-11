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
        ]);

        // SubstituteBindings is in the framework's priority list; a custom
        // alias is not, so both of these ran AFTER route-model binding. That
        // made /admin/users/{user}/* an existence oracle: a plain teacher got
        // 404 for an id that does not exist and 403 for one that does -- the
        // one place on this branch where the non-member received the MORE
        // informative status. Authorization gates belong in front of the
        // binding they guard.
        //
        // `active` is listed first so it still wins over `admin`: a
        // deactivated non-admin is redirected to login rather than told 403.
        $middleware->prependToPriorityList(
            Illuminate\Routing\Middleware\SubstituteBindings::class,
            App\Http\Middleware\EnsureUserIsAdmin::class,
        );
        $middleware->prependToPriorityList(
            App\Http\Middleware\EnsureUserIsAdmin::class,
            App\Http\Middleware\EnsureUserIsActive::class,
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
