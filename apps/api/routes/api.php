<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\NewPasswordController;
use App\Http\Controllers\Api\Auth\OAuthCompletionController;
use App\Http\Controllers\Api\Auth\PasswordResetLinkController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerificationNotificationController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', UserController::class);

Route::prefix('auth')->group(function () {
    Route::post('register', RegisterController::class)->middleware('throttle:6,1');
    Route::post('login', LoginController::class);
    Route::post('logout', LogoutController::class)->middleware('auth');
    Route::post('forgot-password', PasswordResetLinkController::class)->middleware('throttle:6,1');
    Route::post('reset-password', NewPasswordController::class)->middleware('throttle:6,1');
    Route::post('verification-notification', VerificationNotificationController::class)
        ->middleware(['auth:sanctum', 'throttle:6,1']);
    Route::post('oauth/complete', OAuthCompletionController::class)->middleware('throttle:6,1');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('profile', [ProfileController::class, 'show']);
    Route::put('profile', [ProfileController::class, 'update']);
});
