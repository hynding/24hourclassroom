<?php

use App\Models\User;

test('guests get 401 from /api/user', function () {
    $this->getJson('/api/user')->assertUnauthorized();
});

test('authenticated users get their profile from /api/user', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->getJson('/api/user')
        ->assertOk()
        ->assertJsonPath('email', $user->email);
});
