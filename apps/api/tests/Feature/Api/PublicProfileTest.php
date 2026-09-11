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

test('a nonexistent user id is indistinguishable from a student: same status, same body', function () {
    // Reflect the deployed config, not the dev default -- with debug on,
    // a route-model-binding miss's exception message differs from an
    // explicit abort(404), which would itself be an oracle.
    config(['app.debug' => false]);

    $student = User::factory()->create(['role' => 'student']);

    $studentResponse = $this->getJson("/api/users/{$student->id}");
    $missingResponse = $this->getJson('/api/users/999999');

    expect($missingResponse->status())->toBe($studentResponse->status());
    expect($missingResponse->json())->toBe($studentResponse->json());
});

test('the response never leaks email or avatar_path', function () {
    $teacher = User::factory()->create(['role' => 'teacher']);
    Profile::factory()->for($teacher)->create(['avatar_path' => 'avatars/x.jpg']);

    $response = $this->getJson("/api/users/{$teacher->id}")->assertOk();

    expect($response->json())->not->toHaveKey('email');
    expect($response->json('profile'))->not->toHaveKey('avatar_path');
});

test('an authenticated viewer sees their follow state on a teacher profile', function () {
    $this->withHeader('Referer', 'http://localhost:3333');
    $viewer = User::factory()->create();
    $teacher = User::factory()->create(['role' => 'teacher']);
    $this->actingAs($viewer);

    expect($this->getJson("/api/users/{$teacher->id}")->json('is_following'))->toBeFalse();

    $this->postJson("/api/users/{$teacher->id}/follow");

    expect($this->getJson("/api/users/{$teacher->id}")->json('is_following'))->toBeTrue();
});

test('a logged-out visitor gets no viewer state at all', function () {
    $teacher = User::factory()->create(['role' => 'teacher']);

    $body = $this->getJson("/api/users/{$teacher->id}")->assertOk()->json();

    expect($body['is_following'])->toBeNull()
        ->and($body['connection'])->toBeNull();
});

test('connection state carries the direction from the viewers point of view', function () {
    $this->withHeader('Referer', 'http://localhost:3333');
    $viewer = User::factory()->create(['role' => 'teacher']);
    $other = User::factory()->create(['role' => 'teacher']);
    $this->actingAs($viewer);
    $this->postJson("/api/connections/{$other->id}");

    $mine = $this->getJson("/api/users/{$other->id}")->json('connection');
    expect($mine['status'])->toBe('pending')->and($mine['direction'])->toBe('outgoing');

    $this->actingAs($other);
    $theirs = $this->getJson("/api/users/{$viewer->id}")->json('connection');
    expect($theirs['direction'])->toBe('incoming');
});

test('a student profile is name-only to an accepted connection', function () {
    $this->withHeader('Referer', 'http://localhost:3333');
    $teacher = User::factory()->create(['role' => 'teacher']);
    $student = User::factory()->create(['role' => 'student', 'name' => 'Sam Student']);
    Profile::factory()->for($student)->create(['bio' => 'secret bio', 'school' => 'Secret School']);

    $this->actingAs($teacher);
    $this->postJson("/api/connections/{$student->id}");
    $this->actingAs($student);
    $this->patchJson('/api/connections/'.App\Models\Connection::firstOrFail()->id);

    $this->actingAs($teacher);
    $body = $this->getJson("/api/users/{$student->id}")->assertOk()->json();

    expect($body['name'])->toBe('Sam Student')
        // Name only: the profile must not travel with it.
        ->and($body)->not->toHaveKey('profile');
});

test('a student profile is still 404 to a merely pending connection', function () {
    $this->withHeader('Referer', 'http://localhost:3333');
    $teacher = User::factory()->create(['role' => 'teacher']);
    $student = User::factory()->create(['role' => 'student']);
    $this->actingAs($teacher);
    $this->postJson("/api/connections/{$student->id}");

    // Pending is not accepted. Requesting a connection must not be a way to
    // read someone's profile.
    $this->getJson("/api/users/{$student->id}")->assertStatus(404);
});
