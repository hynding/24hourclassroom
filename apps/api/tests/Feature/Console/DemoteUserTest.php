<?php

use App\Enums\Role;
use App\Models\User;

test('it demotes an admin to teacher and points at the admin page', function () {
    User::factory()->create(['email' => 'boss@example.com', 'role' => 'admin']);
    $target = User::factory()->create(['email' => 'ex@example.com', 'role' => 'admin', 'deactivated_at' => now()]);

    $this->artisan('user:demote', ['email' => 'ex@example.com'])
        ->expectsOutputToContain("/admin/users/{$target->id}")
        ->doesntExpectOutputToContain('cannot reach')
        ->assertExitCode(0);

    $target->refresh();
    expect($target->role)->toBe(Role::Teacher)
        ->and($target->deactivated_at)->not->toBeNull(); // untouched: the UI reactivates
});

test('it warns when the remaining admin cannot reach the admin surface', function () {
    User::factory()->unverified()->create(['email' => 'boss@example.com', 'role' => 'admin']);
    User::factory()->create(['email' => 'ex@example.com', 'role' => 'admin']);

    $this->artisan('user:demote', ['email' => 'ex@example.com'])
        ->expectsOutputToContain('cannot reach /admin')
        ->assertExitCode(0);
});

test('it refuses an unknown email, a non-admin, and the only admin', function () {
    User::factory()->create(['email' => 'only@example.com', 'role' => 'admin']);
    User::factory()->create(['email' => 't@example.com', 'role' => 'teacher']);

    $this->artisan('user:demote', ['email' => 'nobody@example.com'])->expectsOutputToContain('No user found')->assertExitCode(1);
    $this->artisan('user:demote', ['email' => 't@example.com'])->expectsOutputToContain('is not an admin')->assertExitCode(1);
    $this->artisan('user:demote', ['email' => 'only@example.com'])->expectsOutputToContain('only admin')->assertExitCode(1);

    expect(User::where('role', Role::Admin)->count())->toBe(1);
});
