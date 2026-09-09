<?php

use App\Models\User;
use Illuminate\Support\Facades\Notification;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('api register creates a user with role, logs in, and sends verification mail', function () {
    Notification::fake();

    $this->postJson('/api/auth/register', [
        'name' => 'Ada', 'email' => 'ada@example.com',
        'password' => 'password', 'password_confirmation' => 'password',
        'role' => 'teacher',
    ])->assertNoContent();

    $this->assertAuthenticated();
    $user = User::where('email', 'ada@example.com')->firstOrFail();
    expect($user->role->value)->toBe('teacher')
        ->and($user->hasVerifiedEmail())->toBeFalse();
    Notification::assertSentTo($user, Illuminate\Auth\Notifications\VerifyEmail::class);
});

test('api register validates role', function () {
    $this->postJson('/api/auth/register', [
        'name' => 'A', 'email' => 'a@example.com',
        'password' => 'password', 'password_confirmation' => 'password',
        'role' => 'wizard',
    ])->assertUnprocessable()->assertJsonValidationErrors('role');
});

test('api login succeeds with valid credentials', function () {
    $user = User::factory()->create();

    $this->postJson('/api/auth/login', [
        'email' => $user->email, 'password' => 'password',
    ])->assertNoContent();

    $this->assertAuthenticatedAs($user);
});

test('api login fails with invalid credentials', function () {
    $user = User::factory()->create();

    $this->postJson('/api/auth/login', [
        'email' => $user->email, 'password' => 'wrong',
    ])->assertUnprocessable()->assertJsonValidationErrors('email');

    $this->assertGuest();
});

test('api user payload includes the role', function () {
    $user = User::factory()->create(['role' => 'student']);

    $this->actingAs($user)->getJson('/api/user')
        ->assertOk()
        ->assertJsonPath('role', 'student');
});

test('api logout ends the session', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->postJson('/api/auth/logout')->assertNoContent();
    $this->assertGuest();
});
