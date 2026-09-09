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

test('registration redirects back to an allowlisted frontend url', function () {
    $this->get('/register?redirect='.urlencode('https://24hourclassroom.com/plans'));

    $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'teacher',
    ])->assertRedirect('https://24hourclassroom.com/plans');
});

test('registration ignores a non-allowlisted redirect and lands on the dashboard', function () {
    $this->get('/register?redirect='.urlencode('https://evil.example/phish'));

    $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'teacher',
    ])->assertRedirect(route('dashboard', absolute: false));
});
