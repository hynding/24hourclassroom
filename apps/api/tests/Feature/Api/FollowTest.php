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

test('a nonexistent user id is indistinguishable from a student: same status, same body', function () {
    // Reflect the deployed config, not the dev default -- with debug on,
    // a route-model-binding miss's exception message differs from an
    // explicit abort(404), which would itself be an oracle.
    config(['app.debug' => false]);

    $follower = User::factory()->create();
    $student = User::factory()->create(['role' => 'student']);
    $this->actingAs($follower);

    $studentResponse = $this->postJson("/api/users/{$student->id}/follow");
    $missingResponse = $this->postJson('/api/users/999999/follow');

    expect($missingResponse->status())->toBe($studentResponse->status());
    expect($missingResponse->json())->toBe($studentResponse->json());

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

test('unfollow is guarded exactly like follow: student, admin and deactivated targets all 404', function () {
    // destroy() called no guard at all, so it answered 204 for any id route
    // binding resolved and 404 only for ids that do not exist -- a complete,
    // unthrottled census of the user table.
    config(['app.debug' => false]);

    $me = User::factory()->create();
    $student = User::factory()->create(['role' => 'student']);
    $admin = User::factory()->create(['role' => 'admin']);
    $deactivated = User::factory()->create(['role' => 'teacher', 'deactivated_at' => now()]);
    $this->actingAs($me);

    $missing = $this->deleteJson('/api/users/999999/follow');
    expect($missing->status())->toBe(404);

    foreach (['student' => $student, 'admin' => $admin, 'deactivated teacher' => $deactivated] as $label => $target) {
        $response = $this->deleteJson("/api/users/{$target->id}/follow");

        expect($response->status())->toBe($missing->status())
            ->and($response->json())->toBe($missing->json());
    }
});

test('unfollowing a real teacher still works', function () {
    // The counter-test for the guard above: it must reject hidden targets,
    // not every target.
    $me = User::factory()->create();
    $teacher = User::factory()->create(['role' => 'teacher']);
    $this->actingAs($me);
    $this->postJson("/api/users/{$teacher->id}/follow")->assertNoContent();

    $this->deleteJson("/api/users/{$teacher->id}/follow")->assertNoContent();

    $this->assertDatabaseCount('follows', 0);
});

test('a deactivated teacher cannot be followed and is indistinguishable from a nonexistent id', function () {
    // 204 here was an oracle for the set of deactivated accounts, and it also
    // delivered a NewFollower notification to an account the platform claims
    // is gone.
    config(['app.debug' => false]);

    $me = User::factory()->create();
    $deactivated = User::factory()->create(['role' => 'teacher', 'deactivated_at' => now()]);
    $this->actingAs($me);

    $response = $this->postJson("/api/users/{$deactivated->id}/follow");
    $missing = $this->postJson('/api/users/999999/follow');

    expect($response->status())->toBe(404)
        ->and($response->status())->toBe($missing->status())
        ->and($response->json())->toBe($missing->json());

    $this->assertDatabaseCount('follows', 0);
    expect($deactivated->notifications()->count())->toBe(0);
});

test('an active teacher can still be followed and is notified', function () {
    // Proves the isActive() guard rejects only deactivated targets.
    $me = User::factory()->create();
    $teacher = User::factory()->create(['role' => 'teacher', 'deactivated_at' => null]);
    $this->actingAs($me);

    $this->postJson("/api/users/{$teacher->id}/follow")->assertNoContent();

    $this->assertDatabaseCount('follows', 1);
    expect($teacher->notifications()->count())->toBe(1);
});
