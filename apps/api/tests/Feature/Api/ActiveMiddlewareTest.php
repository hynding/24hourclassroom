<?php

use App\Models\User;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('a deactivated user gets 401 from /api/user, not 403', function () {
    // 403 here would reject inside the SPA's connectedCallback and take down
    // the entire app shell. This is a regression test for that, not a style
    // preference -- assert the exact status.
    $this->actingAs(User::factory()->create(['deactivated_at' => now()]));

    $this->getJson('/api/user')->assertStatus(401);
});

test('an active user still reaches /api/user', function () {
    $this->actingAs(User::factory()->create(['deactivated_at' => null]));

    $this->getJson('/api/user')->assertOk();
});

test('a deactivated user is blocked from B1 endpoints', function () {
    $this->actingAs(User::factory()->create(['deactivated_at' => now()]));

    $this->getJson('/api/profile')->assertStatus(401);
    $this->putJson('/api/profile', ['school' => 'X'])->assertStatus(401);
});

test('logout is deliberately NOT guarded so a deactivated session can still be cleared', function () {
    // Guarding logout protects nothing -- it only invalidates the session --
    // and authStore.logout() clears its state after the call resolves, so a
    // 401 there would strand the SPA in a signed-in state.
    $this->actingAs(User::factory()->create(['deactivated_at' => now()]));

    $this->postJson('/api/auth/logout')->assertNoContent();
});

test('a deactivated user cannot log in and is told why', function () {
    $user = User::factory()->create([
        'email' => 'gone@example.com',
        'deactivated_at' => now(),
    ]);

    $this->postJson('/api/auth/login', [
        'email' => $user->email, 'password' => 'password',
    ])->assertStatus(422)->assertJsonValidationErrors('email');

    $this->assertGuest();
});

test('an active user can still log in', function () {
    // Proves the login guard rejects only deactivated accounts rather than
    // refusing everyone.
    $user = User::factory()->create(['email' => 'here@example.com', 'deactivated_at' => null]);

    $this->postJson('/api/auth/login', [
        'email' => $user->email, 'password' => 'password',
    ])->assertNoContent();

    $this->assertAuthenticated();
});

test('deactivated_at is never serialized to the client', function () {
    $user = User::factory()->create(['deactivated_at' => null]);
    $this->actingAs($user);

    expect($this->getJson('/api/user')->json())->not->toHaveKey('deactivated_at');
});
