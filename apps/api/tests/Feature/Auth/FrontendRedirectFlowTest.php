<?php

use App\Models\User;

beforeEach(function () {
    config(['app.frontend_urls' => 'https://24hourclassroom.com']);
});

test('login redirects back to an allowlisted frontend url', function () {
    $user = User::factory()->create();

    $this->get('/login?redirect='.urlencode('https://24hourclassroom.com/plans'));

    $this->post('/login', ['email' => $user->email, 'password' => 'password'])
        ->assertRedirect('https://24hourclassroom.com/plans');
});

test('login ignores a non-allowlisted redirect and lands on the dashboard', function () {
    $user = User::factory()->create();

    $this->get('/login?redirect='.urlencode('https://evil.example/phish'));

    $this->post('/login', ['email' => $user->email, 'password' => 'password'])
        ->assertRedirect(route('dashboard', absolute: false));
});
