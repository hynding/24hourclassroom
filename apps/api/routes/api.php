<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\NewPasswordController;
use App\Http\Controllers\Api\Auth\OAuthCompletionController;
use App\Http\Controllers\Api\Auth\PasswordResetLinkController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerificationNotificationController;
use App\Http\Controllers\Api\ConnectionController;
use App\Http\Controllers\Api\FollowController;
use App\Http\Controllers\Api\LibraryController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ProfileAvatarController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\PublicProfileController;
use App\Http\Controllers\Api\SiteController;
use App\Http\Controllers\Api\TeacherDirectoryController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\TestCopyController;
use App\Http\Controllers\Api\TestPublishController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'active'])->get('/user', UserController::class);

Route::prefix('auth')->group(function () {
    Route::post('register', RegisterController::class)->middleware('throttle:6,1');
    Route::post('login', LoginController::class);
    Route::post('logout', LogoutController::class)->middleware('auth');
    Route::post('forgot-password', PasswordResetLinkController::class)->middleware('throttle:6,1');
    Route::post('reset-password', NewPasswordController::class)->middleware('throttle:6,1');
    Route::post('verification-notification', VerificationNotificationController::class)
        ->middleware(['auth:sanctum', 'active', 'throttle:6,1']);
    Route::post('oauth/complete', OAuthCompletionController::class)->middleware('throttle:6,1');
});

// throttle:60,1 -- deliberately the same limit the public group below already
// carries, so this is a consistency fix rather than a new product decision.
// The group had none, which is what let the review's enumeration sweeps run at
// full speed; each POST /api/connections/{id} probe also writes a row and
// fires a notification, so an uncapped census doubled as inbox spam. The
// limiter keys on the user id, so it caps an individual rather than the host.
Route::middleware(['auth:sanctum', 'verified', 'active', 'throttle:60,1'])->group(function () {
    Route::get('profile', [ProfileController::class, 'show']);
    Route::put('profile', [ProfileController::class, 'update']);
    Route::post('profile/avatar', [ProfileAvatarController::class, 'store']);
    Route::delete('profile/avatar', [ProfileAvatarController::class, 'destroy']);

    Route::post('users/{user}/follow', [FollowController::class, 'store']);
    Route::delete('users/{user}/follow', [FollowController::class, 'destroy']);

    Route::get('connections', [ConnectionController::class, 'index']);
    Route::get('connections/pending', [ConnectionController::class, 'pending']);
    Route::post('connections/{user}', [ConnectionController::class, 'store']);
    Route::patch('connections/{connection}', [ConnectionController::class, 'update']);
    Route::delete('connections/{connection}', [ConnectionController::class, 'destroy']);

    Route::get('notifications', [NotificationController::class, 'index']);
    Route::get('notifications/unread-count', [NotificationController::class, 'unreadCount']);
    Route::post('notifications/read', [NotificationController::class, 'read']);

    Route::get('tests', [TestController::class, 'index']);
    Route::post('tests', [TestController::class, 'store']);
    Route::put('tests/{test}', [TestController::class, 'update']);
    Route::delete('tests/{test}', [TestController::class, 'destroy']);
    Route::post('tests/{test}/publish', [TestPublishController::class, 'publish']);
    Route::post('tests/{test}/unpublish', [TestPublishController::class, 'unpublish']);
    Route::post('tests/{test}/copy', TestCopyController::class);
});

// `active` here too. These two routes are reachable by guests -- the
// middleware passes a null user straight through -- but a DEACTIVATED session
// must not keep the authenticated-viewer privileges the payload carries
// (a student's name behind an accepted connection, is_following, connection).
Route::middleware(['throttle:60,1', 'active'])->group(function () {
    Route::get('teachers', TeacherDirectoryController::class);
    Route::get('users/{user}', PublicProfileController::class);
    Route::get('library', LibraryController::class);
    Route::get('tests/{test}', [TestController::class, 'show']);
});

// Site configuration: no `auth`, no `active`. The public group above carries
// `active` because its payloads hold viewer-dependent privileges; this one
// has none, and the SPA fetches it at boot -- it must never be the request
// that 401s a deactivated session. Sanctum's stateful pipeline still runs on
// the whole api group, which is fine: AuthenticateSession only ends a session
// whose password changed, correct on any route.
Route::middleware('throttle:60,1')->get('site', SiteController::class);
