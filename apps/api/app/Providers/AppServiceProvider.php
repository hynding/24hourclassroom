<?php

namespace App\Providers;

use App\Support\FrontendRedirect;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return FrontendRedirect::spaOrigin()
                .'/reset-password?token='.$token
                .'&email='.urlencode($notifiable->getEmailForPasswordReset());
        });

        // Constrains EVERY {material} registration at once (there is no
        // RouteServiceProvider in this app). Without it, the public
        // GET /materials/{material} could swallow /materials/shared depending
        // on registration order or what the route cache produced.
        Route::pattern('material', '[0-9]+');

        // {share} is resolved by hand inside MaterialShareController::destroy
        // (after the author check, so share ids are not an oracle); without a
        // pattern a non-numeric segment would reach `int $share` as a string.
        Route::pattern('share', '[0-9]+');

        // A top-level <a href> navigation to the API host sends that host's
        // session cookie (SameSite=Lax allows top-level GET), so Sanctum
        // resolves the user and a throttle:60,1 download would draw on the
        // caller's single 60/min budget -- the CLAUDE.md gotcha. Downloads get
        // their own bucket. At 30/min per person, a 429 is a scripted client.
        RateLimiter::for('downloads', fn (Request $request) => Limit::perMinute(30)
            ->by($request->user()?->id ?: $request->ip()));
    }
}
