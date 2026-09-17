<?php

use App\Enums\Role;
use App\Models\User;

test('it promotes a user to admin by email', function () {
    $user = User::factory()->create(['email' => 'teach@example.com', 'role' => 'teacher']);

    $this->artisan('user:promote', ['email' => 'teach@example.com'])
        ->assertExitCode(0);

    expect($user->refresh()->role)->toBe(Role::Admin);
});

test('--verify clears the two gates that keep an admin out of the admin surface', function () {
    $user = User::factory()->unverified()->create([
        'email' => 'teach@example.com',
        'role' => 'teacher',
        'deactivated_at' => now(),
    ]);

    $this->artisan('user:promote', ['email' => 'teach@example.com', '--verify' => true])
        ->assertExitCode(0);

    $user->refresh();
    expect($user->role)->toBe(Role::Admin)
        ->and($user->email_verified_at)->not->toBeNull()
        ->and($user->deactivated_at)->toBeNull();
});

test('it warns when the promoted account still cannot reach the admin surface', function () {
    User::factory()->unverified()->create([
        'email' => 'teach@example.com',
        'role' => 'teacher',
        'deactivated_at' => now(),
    ]);

    $this->artisan('user:promote', ['email' => 'teach@example.com'])
        ->expectsOutputToContain('not verified')
        ->expectsOutputToContain('deactivated')
        ->assertExitCode(0);
});

test('a promotion that clears every gate reports no warning', function () {
    User::factory()->create(['email' => 'teach@example.com', 'role' => 'teacher']);

    $this->artisan('user:promote', ['email' => 'teach@example.com'])
        ->doesntExpectOutputToContain('not verified')
        ->doesntExpectOutputToContain('deactivated')
        ->assertExitCode(0);
});

test('without --verify the verification and deactivation gates are left alone', function () {
    $deactivatedAt = now()->subDay();
    $user = User::factory()->unverified()->create([
        'email' => 'teach@example.com',
        'role' => 'teacher',
        'deactivated_at' => $deactivatedAt,
    ]);

    $this->artisan('user:promote', ['email' => 'teach@example.com'])
        ->assertExitCode(0);

    // Promotion is not reinstatement: a deactivated account stays out, and an
    // unverified one stays unverified, unless --verify says otherwise.
    $user->refresh();
    expect($user->role)->toBe(Role::Admin)
        ->and($user->email_verified_at)->toBeNull()
        ->and($user->deactivated_at->timestamp)->toBe($deactivatedAt->timestamp);
});

test('an unknown email fails without promoting anyone', function () {
    User::factory()->create(['email' => 'teach@example.com', 'role' => 'teacher']);

    $this->artisan('user:promote', ['email' => 'nobody@example.com'])
        ->expectsOutputToContain('No user found')
        ->assertExitCode(1);

    // Exclusion: a miss must not promote some other account.
    expect(User::where('role', Role::Admin)->count())->toBe(0);
});
