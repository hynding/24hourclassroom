<?php

use App\Models\User;
use App\Support\FrontendRedirect;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;

test('spaOrigin returns the first FRONTEND_URLS entry', function () {
    config(['app.frontend_urls' => 'https://24hourclassroom.com,http://localhost:3333']);
    expect(FrontendRedirect::spaOrigin())->toBe('https://24hourclassroom.com');
});

test('forgot-password sends a reset link pointing at the SPA', function () {
    Notification::fake();
    config(['app.frontend_urls' => 'https://24hourclassroom.com']);
    $user = User::factory()->create();

    $this->postJson('/api/auth/forgot-password', ['email' => $user->email])->assertOk();

    Notification::assertSentTo($user, ResetPassword::class, function (ResetPassword $notification) use ($user) {
        $url = $notification->toMail($user)->actionUrl;
        return str_starts_with($url, 'https://24hourclassroom.com/reset-password?token=');
    });
});

test('reset-password resets with a valid token', function () {
    Notification::fake();
    $user = User::factory()->create();
    $token = Illuminate\Support\Facades\Password::createToken($user);

    $this->postJson('/api/auth/reset-password', [
        'token' => $token,
        'email' => $user->email,
        'password' => 'new-password-123',
        'password_confirmation' => 'new-password-123',
    ])->assertNoContent();

    expect(Illuminate\Support\Facades\Hash::check('new-password-123', $user->fresh()->password))->toBeTrue();
});

test('reset-password rejects a bad token', function () {
    $user = User::factory()->create();

    $this->postJson('/api/auth/reset-password', [
        'token' => 'bogus',
        'email' => $user->email,
        'password' => 'new-password-123',
        'password_confirmation' => 'new-password-123',
    ])->assertUnprocessable()->assertJsonValidationErrors('email');
});
