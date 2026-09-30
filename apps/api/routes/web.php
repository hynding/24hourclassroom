<?php

use App\Http\Controllers\Admin\GenerationAdminController;
use App\Http\Controllers\Admin\MaterialAdminController;
use App\Http\Controllers\Admin\SiteThemeController;
use App\Http\Controllers\Admin\TestAdminController;
use App\Http\Controllers\Admin\UserAccountController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Auth\GoogleOAuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified', 'active'])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
});

Route::middleware(['auth', 'verified', 'active', 'admin'])->prefix('admin')->group(function () {
    Route::get('users', [UserAdminController::class, 'index'])->name('admin.users');
    Route::get('users/{user}', [UserAdminController::class, 'show'])->name('admin.users.show');
    Route::post('users/{user}/verification', [UserAccountController::class, 'resendVerification'])->middleware('throttle:admin-resend');
    Route::patch('users/{user}/verify', [UserAccountController::class, 'forceVerify']);
    Route::delete('users/{user}/anthropic-key', [UserAccountController::class, 'clearAnthropicKey']);
    Route::delete('users/{user}', [UserAccountController::class, 'destroy']);
    Route::patch('users/{user}/role', [UserAdminController::class, 'updateRole']);
    Route::patch('users/{user}/deactivate', [UserAdminController::class, 'deactivate']);
    Route::patch('users/{user}/reactivate', [UserAdminController::class, 'reactivate']);
    Route::delete('users/{user}/profile-content', [UserAdminController::class, 'clearProfileContent']);

    // Not "appearance": routes/settings.php already owns `settings/appearance`
    // (per-user light/dark for the admin UI) and the route name `appearance`.
    Route::get('site-theme', [SiteThemeController::class, 'edit'])->name('admin.site-theme');
    Route::patch('site-theme', [SiteThemeController::class, 'update']);

    Route::get('tests', [TestAdminController::class, 'index'])->name('admin.tests');
    Route::post('tests/{test}/unpublish', [TestAdminController::class, 'unpublish']);
    Route::delete('tests/{test}', [TestAdminController::class, 'destroy']);

    Route::get('materials', [MaterialAdminController::class, 'index'])->name('admin.materials');
    Route::post('materials/{material}/unpublish', [MaterialAdminController::class, 'unpublish']);
    Route::delete('materials/{material}', [MaterialAdminController::class, 'destroy']);

    Route::get('generations', [GenerationAdminController::class, 'index'])->name('admin.generations');
    Route::get('generations/{generation}', [GenerationAdminController::class, 'show']);
    Route::post('generations/{generation}/cancel', [GenerationAdminController::class, 'cancel']);
    Route::post('generations/{generation}/teardown', [GenerationAdminController::class, 'retryTeardown']);
});

Route::get('auth/google/redirect', [GoogleOAuthController::class, 'redirect'])->name('oauth.google.redirect');
Route::get('auth/google/callback', [GoogleOAuthController::class, 'callback'])->name('oauth.google.callback');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
