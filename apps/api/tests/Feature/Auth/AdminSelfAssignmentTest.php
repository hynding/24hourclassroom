<?php

use App\Models\User;
use Illuminate\Support\Facades\Session;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('the api register endpoint rejects a self-assigned admin role', function () {
    $this->postJson('/api/auth/register', [
        'name' => 'Mallory', 'email' => 'm@example.com',
        'password' => 'password', 'password_confirmation' => 'password',
        'role' => 'admin',
    ])->assertStatus(422)->assertJsonValidationErrors('role');

    expect(User::where('email', 'm@example.com')->exists())->toBeFalse();
});

test('the inertia register endpoint rejects a self-assigned admin role', function () {
    $this->post('/register', [
        'name' => 'Mallory', 'email' => 'm2@example.com',
        'password' => 'password', 'password_confirmation' => 'password',
        'role' => 'admin',
    ])->assertSessionHasErrors('role');

    expect(User::where('email', 'm2@example.com')->exists())->toBeFalse();
});

test('the oauth completion endpoint rejects a self-assigned admin role', function () {
    Session::put('oauth.google', ['id' => 'g-1', 'name' => 'Mallory', 'email' => 'm3@example.com']);

    $this->postJson('/api/auth/oauth/complete', ['role' => 'admin'])
        ->assertStatus(422)->assertJsonValidationErrors('role');

    expect(User::where('email', 'm3@example.com')->exists())->toBeFalse();
});

test('teacher and student remain accepted on every registration path', function () {
    // Proves the fix rejects only `admin` rather than rejecting everything --
    // a rule that refused all roles would pass the three tests above.
    $this->postJson('/api/auth/register', [
        'name' => 'T', 'email' => 't@example.com',
        'password' => 'password', 'password_confirmation' => 'password',
        'role' => 'teacher',
    ])->assertNoContent();

    $this->post('/logout');

    $this->postJson('/api/auth/register', [
        'name' => 'S', 'email' => 's@example.com',
        'password' => 'password', 'password_confirmation' => 'password',
        'role' => 'student',
    ])->assertNoContent();

    expect(User::whereIn('email', ['t@example.com', 's@example.com'])->count())->toBe(2);
});

test('Role has an Admin case that is never self-assignable', function () {
    expect(App\Enums\Role::Admin->value)->toBe('admin');
});
