<?php

use App\Models\Profile;
use App\Models\User;

test('a logged-out visitor sees a full teacher profile', function () {
    $teacher = User::factory()->create(['role' => 'teacher', 'name' => 'Ada Teacher']);
    Profile::factory()->for($teacher)->create(['bio' => 'I teach math.', 'school' => 'Rivet High']);

    $this->getJson("/api/users/{$teacher->id}")
        ->assertOk()
        ->assertJsonPath('name', 'Ada Teacher')
        ->assertJsonPath('role', 'teacher')
        ->assertJsonPath('profile.bio', 'I teach math.')
        ->assertJsonPath('profile.school', 'Rivet High');
});

test('a teacher with no profile row returns an empty profile, not an error', function () {
    $teacher = User::factory()->create(['role' => 'teacher']);

    $this->getJson("/api/users/{$teacher->id}")
        ->assertOk()
        ->assertJsonPath('profile.bio', null)
        ->assertJsonPath('profile.school', null)
        ->assertJsonPath('profile.specialties', null)
        ->assertJsonPath('profile.subjects', [])
        ->assertJsonPath('profile.grade_levels', [])
        ->assertJsonPath('profile.avatar_url', null);
});

test('student profiles are 404 to a logged-out visitor', function () {
    $student = User::factory()->create(['role' => 'student']);

    $this->getJson("/api/users/{$student->id}")->assertStatus(404);
});

test('student profiles are 404 even to an authenticated teacher', function () {
    $this->withHeader('Referer', 'http://localhost:3333');
    $student = User::factory()->create(['role' => 'student']);
    $this->actingAs(User::factory()->create(['role' => 'teacher']));

    $this->getJson("/api/users/{$student->id}")->assertStatus(404);
});

test('a student cannot see their own profile through the public endpoint', function () {
    $this->withHeader('Referer', 'http://localhost:3333');
    $student = User::factory()->create(['role' => 'student']);
    $this->actingAs($student);

    $this->getJson("/api/users/{$student->id}")->assertStatus(404);
});

test('an unknown user is 404', function () {
    // Self-contained: proves the route exists (200 for a real teacher) and
    // still 404s for an unknown id, so this can't pass against a missing route.
    $teacher = User::factory()->create(['role' => 'teacher']);
    $this->getJson("/api/users/{$teacher->id}")->assertOk();

    $this->getJson('/api/users/999999')->assertStatus(404);
});

test('the response never leaks email or avatar_path', function () {
    $teacher = User::factory()->create(['role' => 'teacher']);
    Profile::factory()->for($teacher)->create(['avatar_path' => 'avatars/x.jpg']);

    $response = $this->getJson("/api/users/{$teacher->id}")->assertOk();

    expect($response->json())->not->toHaveKey('email');
    expect($response->json('profile'))->not->toHaveKey('avatar_path');
});
