<?php

use App\Models\Profile;
use App\Models\User;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('a user with no profile row reads an empty profile', function () {
    $this->actingAs(User::factory()->create());

    $this->getJson('/api/profile')
        ->assertOk()
        ->assertExactJson([
            'bio' => null,
            'school' => null,
            'specialties' => null,
            'subjects' => [],
            'grade_levels' => [],
            'avatar_url' => null,
        ]);
});

test('put lazily creates the profile row', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $this->putJson('/api/profile', [
        'bio' => 'I teach math.',
        'school' => 'Rivet High',
        'specialties' => 'Robotics club',
        'subjects' => ['math', 'computer-science'],
        'grade_levels' => ['9-12'],
    ])->assertOk()->assertJsonPath('school', 'Rivet High');

    $this->assertDatabaseHas('profiles', ['user_id' => $user->id, 'school' => 'Rivet High']);
    expect($user->fresh()->profile->subjects)->toBe(['math', 'computer-science']);
});

test('put updates an existing profile without creating a second row', function () {
    $user = User::factory()->create();
    Profile::factory()->for($user)->create(['school' => 'Old']);
    $this->actingAs($user);

    $this->putJson('/api/profile', ['school' => 'New'])->assertOk();

    expect(Profile::where('user_id', $user->id)->count())->toBe(1)
        ->and($user->fresh()->profile->school)->toBe('New');
});

test('put rejects values outside the curated taxonomy', function () {
    $this->actingAs(User::factory()->create());

    $this->putJson('/api/profile', [
        'subjects' => ['underwater-basket-weaving'],
        'grade_levels' => ['phd'],
    ])->assertStatus(422)->assertJsonValidationErrors(['subjects.0', 'grade_levels.0']);
});

test('put rejects an over-long bio', function () {
    $this->actingAs(User::factory()->create());

    $this->putJson('/api/profile', ['bio' => str_repeat('a', 2001)])
        ->assertStatus(422)
        ->assertJsonValidationErrors('bio');
});

test('unverified users are blocked from the profile endpoints with 403', function () {
    $this->actingAs(User::factory()->unverified()->create());

    $this->getJson('/api/profile')->assertStatus(403);
    $this->putJson('/api/profile', ['school' => 'X'])->assertStatus(403);
});

test('unverified users can still reach /api/user', function () {
    $this->actingAs(User::factory()->unverified()->create());

    $this->getJson('/api/user')->assertOk();
});

test('guests are rejected', function () {
    $this->getJson('/api/profile')->assertStatus(401);
});
