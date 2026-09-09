<?php

use App\Models\User;

test('inertia registration stores the chosen role', function () {
    $response = $this->post('/register', [
        'name' => 'Test Teacher',
        'email' => 'teacher@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'student',
    ]);

    $response->assertRedirect(route('dashboard', absolute: false));
    expect(User::where('email', 'teacher@example.com')->first()->role->value)->toBe('student');
});

test('inertia registration rejects a missing or invalid role', function () {
    $this->post('/register', [
        'name' => 'T', 'email' => 't@example.com',
        'password' => 'password', 'password_confirmation' => 'password',
    ])->assertSessionHasErrors('role');

    $this->post('/register', [
        'name' => 'T', 'email' => 't2@example.com',
        'password' => 'password', 'password_confirmation' => 'password',
        'role' => 'wizard',
    ])->assertSessionHasErrors('role');
});

test('google_id is hidden from serialization', function () {
    $user = User::factory()->create();
    expect($user->toArray())->not->toHaveKey('google_id');
});
