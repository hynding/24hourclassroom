<?php

use App\Models\Profile;
use App\Models\User;
use App\Support\UserSummary;

test('for() returns exactly id, name, role, avatar_url and never email', function () {
    $user = User::factory()->create(['name' => 'Ada Lovelace', 'email' => 'ada@example.com']);
    Profile::factory()->for($user)->create();

    $summary = UserSummary::for($user);

    expect($summary)->toHaveKeys(['id', 'name', 'role', 'avatar_url'])
        ->and($summary)->toHaveCount(4)
        ->and($summary)->not->toHaveKey('email');
});

test('for() returns a null avatar_url and does not throw when the profile is lazily unset', function () {
    $user = User::factory()->create();

    expect($user->profile)->toBeNull();

    $summary = UserSummary::for($user);

    expect($summary['avatar_url'])->toBeNull();
});
