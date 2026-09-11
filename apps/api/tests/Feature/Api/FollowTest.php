<?php

use App\Models\User;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('a user follows a teacher', function () {
    $follower = User::factory()->create();
    $teacher = User::factory()->create(['role' => 'teacher']);
    $this->actingAs($follower);

    $this->postJson("/api/users/{$teacher->id}/follow")->assertNoContent();

    $this->assertDatabaseHas('follows', [
        'follower_id' => $follower->id, 'followed_id' => $teacher->id,
    ]);
});

test('following twice is idempotent and does not create a second row', function () {
    $follower = User::factory()->create();
    $teacher = User::factory()->create(['role' => 'teacher']);
    $this->actingAs($follower);

    $this->postJson("/api/users/{$teacher->id}/follow")->assertNoContent();
    $this->postJson("/api/users/{$teacher->id}/follow")->assertNoContent();

    expect(DB::table('follows')->where('follower_id', $follower->id)->count())->toBe(1);
});

test('unfollowing removes the row and is idempotent', function () {
    $follower = User::factory()->create();
    $teacher = User::factory()->create(['role' => 'teacher']);
    $this->actingAs($follower);
    $this->postJson("/api/users/{$teacher->id}/follow");

    $this->deleteJson("/api/users/{$teacher->id}/follow")->assertNoContent();
    $this->deleteJson("/api/users/{$teacher->id}/follow")->assertNoContent();

    $this->assertDatabaseMissing('follows', ['follower_id' => $follower->id]);
});

test('students cannot be followed', function () {
    $follower = User::factory()->create();
    $student = User::factory()->create(['role' => 'student']);
    $this->actingAs($follower);

    $this->postJson("/api/users/{$student->id}/follow")->assertStatus(404);

    $this->assertDatabaseCount('follows', 0);
});

test('a nonexistent user id also returns 404, indistinguishable from a student', function () {
    $follower = User::factory()->create();
    $this->actingAs($follower);

    $this->postJson('/api/users/999999/follow')->assertStatus(404);

    $this->assertDatabaseCount('follows', 0);
});

test('a user cannot follow themselves', function () {
    $teacher = User::factory()->create(['role' => 'teacher']);
    $this->actingAs($teacher);

    $this->postJson("/api/users/{$teacher->id}/follow")
        ->assertStatus(422)->assertJsonValidationErrors('user');

    $this->assertDatabaseCount('follows', 0);
});

test('an unverified user cannot follow', function () {
    $this->actingAs(User::factory()->unverified()->create());
    $teacher = User::factory()->create(['role' => 'teacher']);

    $this->postJson("/api/users/{$teacher->id}/follow")->assertStatus(403);
});

test('a guest cannot follow', function () {
    $teacher = User::factory()->create(['role' => 'teacher']);

    $this->postJson("/api/users/{$teacher->id}/follow")->assertStatus(401);
});
