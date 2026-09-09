<?php

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;

test('resend endpoint notifies unverified users', function () {
    Notification::fake();
    $user = User::factory()->unverified()->create();

    $this->actingAs($user)->postJson('/api/auth/verification-notification')->assertNoContent();

    Notification::assertSentTo($user, VerifyEmail::class);
});

test('verifying redirects to the SPA origin', function () {
    config(['app.frontend_urls' => 'https://24hourclassroom.com']);
    $user = User::factory()->unverified()->create();

    $url = URL::temporarySignedRoute('verification.verify', now()->addMinutes(60), [
        'id' => $user->id,
        'hash' => sha1($user->email),
    ]);

    $this->actingAs($user)->get($url)
        ->assertRedirect('https://24hourclassroom.com/?verified=1');

    expect($user->fresh()->hasVerifiedEmail())->toBeTrue();
});
