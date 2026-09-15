<?php

use App\Http\Controllers\Admin\SiteThemeController;
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
    Route::patch('users/{user}/role', [UserAdminController::class, 'updateRole']);
    Route::patch('users/{user}/deactivate', [UserAdminController::class, 'deactivate']);
    Route::patch('users/{user}/reactivate', [UserAdminController::class, 'reactivate']);
    Route::delete('users/{user}/profile-content', [UserAdminController::class, 'clearProfileContent']);

    // Not "appearance": routes/settings.php already owns `settings/appearance`
    // (per-user light/dark for the admin UI) and the route name `appearance`.
    Route::get('site-theme', [SiteThemeController::class, 'edit'])->name('admin.site-theme');
    Route::patch('site-theme', [SiteThemeController::class, 'update']);
});

Route::get('auth/google/redirect', [GoogleOAuthController::class, 'redirect'])->name('oauth.google.redirect');
Route::get('auth/google/callback', [GoogleOAuthController::class, 'callback'])->name('oauth.google.callback');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
