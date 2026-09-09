<?php

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

function fakeGoogleUser(string $id, string $email, string $name = 'Goo Gler', bool $verified = true): object
{
    $user = Mockery::mock(Laravel\Socialite\Two\User::class);
    $user->shouldReceive('getId')->andReturn($id);
    $user->shouldReceive('getEmail')->andReturn($email);
    $user->shouldReceive('getName')->andReturn($name);
    $user->shouldReceive('getNickname')->andReturn(null);
    $user->user = ['email_verified' => $verified];

    return $user;
}

function mockCallback(object $googleUser): void
{
    Socialite::shouldReceive('driver->user')->andReturn($googleUser);
}

beforeEach(function () {
    config(['app.frontend_urls' => 'https://24hourclassroom.com']);
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('known google_id logs straight in', function () {
    $user = User::factory()->create();
    $user->forceFill(['google_id' => 'g-123'])->save();
    mockCallback(fakeGoogleUser('g-123', $user->email));

    $this->get('/auth/google/callback')->assertRedirect('https://24hourclassroom.com');
    $this->assertAuthenticatedAs($user);
});

test('verified google email auto-links an existing account', function () {
    $user = User::factory()->unverified()->create();
    mockCallback(fakeGoogleUser('g-456', $user->email));

    $this->get('/auth/google/callback')->assertRedirect('https://24hourclassroom.com');

    $fresh = $user->fresh();
    expect($fresh->google_id)->toBe('g-456')
        ->and($fresh->hasVerifiedEmail())->toBeTrue();
    $this->assertAuthenticatedAs($user);
});

test('unverified google email does NOT auto-link', function () {
    $user = User::factory()->create();
    mockCallback(fakeGoogleUser('g-457', $user->email, verified: false));

    $this->get('/auth/google/callback')->assertRedirect('https://24hourclassroom.com/register/role');
    $this->assertGuest();
    expect($user->fresh()->google_id)->toBeNull();
});

test('new user is parked and completes with a role', function () {
    mockCallback(fakeGoogleUser('g-789', 'new@example.com', 'Newbie'));

    $this->get('/auth/google/callback')->assertRedirect('https://24hourclassroom.com/register/role');
    $this->assertGuest();

    $this->postJson('/api/auth/oauth/complete', ['role' => 'student'])->assertNoContent();

    $user = User::where('email', 'new@example.com')->firstOrFail();
    expect($user->role->value)->toBe('student')
        ->and($user->google_id)->toBe('g-789')
        ->and($user->hasVerifiedEmail())->toBeTrue()
        ->and($user->password)->toBeNull();
    $this->assertAuthenticatedAs($user);
});

test('oauth complete without a parked identity is a 422', function () {
    $this->postJson('/api/auth/oauth/complete', ['role' => 'teacher'])
        ->assertUnprocessable()->assertJsonValidationErrors('role');
});

test('oauth complete with an already-taken email is a 422', function () {
    User::factory()->create(['email' => 'taken@example.com']);
    mockCallback(fakeGoogleUser('g-999', 'taken@example.com', verified: false));
    $this->get('/auth/google/callback');

    $this->postJson('/api/auth/oauth/complete', ['role' => 'teacher'])
        ->assertUnprocessable()->assertJsonValidationErrors('role');
});

test('a google email_verified claim of string false does not auto-link', function () {
    $user = User::factory()->create();
    $googleUser = fakeGoogleUser('g-458', $user->email);
    $googleUser->user = ['email_verified' => 'false'];
    mockCallback($googleUser);

    $this->get('/auth/google/callback')->assertRedirect('https://24hourclassroom.com/register/role');
    $this->assertGuest();
    expect($user->fresh()->google_id)->toBeNull();
});

test('email match with a different existing google_id is not relinked', function () {
    $user = User::factory()->create();
    $user->forceFill(['google_id' => 'g-original'])->save();
    mockCallback(fakeGoogleUser('g-intruder', $user->email));

    $this->get('/auth/google/callback')->assertRedirect('https://24hourclassroom.com/register/role');
    $this->assertGuest();
    expect($user->fresh()->google_id)->toBe('g-original');
});
