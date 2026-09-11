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

test('for() withholds a students avatar_url so it agrees with the public profile endpoint', function () {
    // Decision 5 says an accepted connection sees a student NAME ONLY --
    // PublicProfileController even omits the `profile` key entirely so the
    // shape gives nothing away. UserSummary disagreed: for the same accepted
    // student, GET /api/users/{id} returned {id,name,role} while
    // GET /api/connections added avatar_url. Two files, two answers to what
    // "name only" means.
    $student = User::factory()->create(['role' => 'student']);
    Profile::factory()->for($student)->create()->forceFill(['avatar_path' => 'avatars/secret.png'])->save();
    $student->load('profile');

    expect($student->profile->avatar_url)->not->toBeNull();

    $summary = UserSummary::for($student);

    // The key stays -- @24hc/shared declares avatar_url: string | null, and
    // dropping it would make the payload shape itself say "this is a
    // student".
    expect($summary)->toHaveCount(4)
        ->and($summary)->toHaveKey('avatar_url')
        ->and($summary['avatar_url'])->toBeNull()
        ->and($summary['name'])->toBe($student->name);
});

test('for() still returns a teachers avatar_url', function () {
    // The counter-test: teachers are publicly discoverable with an avatar by
    // design, so the redaction must be scoped to students.
    $teacher = User::factory()->create(['role' => 'teacher']);
    Profile::factory()->for($teacher)->create()->forceFill(['avatar_path' => 'avatars/public.png'])->save();
    $teacher->load('profile');

    expect(UserSummary::for($teacher)['avatar_url'])->toBe($teacher->profile->avatar_url)
        ->and(UserSummary::for($teacher)['avatar_url'])->not->toBeNull();
});
