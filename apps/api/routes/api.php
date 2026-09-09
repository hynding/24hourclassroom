<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', UserController::class);

Route::prefix('auth')->group(function () {
    Route::post('register', RegisterController::class)->middleware('throttle:6,1');
    Route::post('login', LoginController::class);
    Route::post('logout', LogoutController::class)->middleware('auth');
});
