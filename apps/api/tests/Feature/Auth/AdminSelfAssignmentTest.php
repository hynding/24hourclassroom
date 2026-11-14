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

test('tutor, assistant and guardian are accepted on every registration path', function () {
    foreach (['tutor', 'assistant', 'guardian'] as $role) {
        $this->postJson('/api/auth/register', [
            'name' => ucfirst($role), 'email' => "api-{$role}@example.com",
            'password' => 'password', 'password_confirmation' => 'password',
            'role' => $role,
        ])->assertNoContent();
        $this->post('/logout');

        expect(User::where('email', "api-{$role}@example.com")->first()->role->value)->toBe($role);
    }

    $this->post('/register', [
        'name' => 'G', 'email' => 'web-guardian@example.com',
        'password' => 'password', 'password_confirmation' => 'password',
        'role' => 'guardian',
    ])->assertSessionHasNoErrors();
    $this->post('/logout');

    Session::put('oauth.google', ['id' => 'g-2', 'name' => 'Tess Tutor', 'email' => 'oauth-tutor@example.com']);
    $this->postJson('/api/auth/oauth/complete', ['role' => 'tutor'])->assertSuccessful();

    expect(User::where('email', 'web-guardian@example.com')->first()->role->value)->toBe('guardian')
        ->and(User::where('email', 'oauth-tutor@example.com')->first()->role->value)->toBe('tutor');
});
