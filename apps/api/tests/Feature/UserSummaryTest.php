<?php

use App\Enums\Role;
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

test('for() surrenders an avatar_url only for a teacher, across every role the enum defines', function () {
    // The same denylist-over-an-open-enum shape as A8 and N1: this shipped as
    // `role === Role::Student ? null : avatar_url`, so Role::Admin -- added in
    // this milestone -- kept its avatar. Reachable without any admin action:
    // a teacher with an accepted connection who is later promoted still
    // appears in the counterpart's /api/connections, because role changes
    // leave existing graph rows intact by design.
    //
    // Iterating Role::cases() means a role added later is covered the day it
    // is added, and widening the allowlist requires editing this test.
    foreach (Role::cases() as $role) {
        $user = User::factory()->create(['role' => $role->value]);
        Profile::factory()->for($user)->create()
            ->forceFill(['avatar_path' => "avatars/{$role->value}.png"])->save();
        $user->load('profile');

        // Fixture sanity: without this the null assertions below could pass
        // because there was never an avatar to withhold.
        expect($user->profile->avatar_url)->toContain("avatars/{$role->value}.png");

        $summary = UserSummary::for($user);

        // The key always survives -- @24hc/shared declares `string | null`, and
        // a missing key would make the payload shape announce the role.
        expect($summary)->toHaveCount(4)->and($summary)->toHaveKey('avatar_url');

        if ($role === Role::Teacher) {
            expect($summary['avatar_url'])->toBe($user->profile->avatar_url);

            continue;
        }

        expect($summary['avatar_url'])->toBeNull();
    }
});
