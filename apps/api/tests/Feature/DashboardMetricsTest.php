<?php

use App\Models\Connection;
use App\Models\Follow;
use App\Models\User;

test('an admin sees metrics on the dashboard', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $teacher = User::factory()->create(['role' => 'teacher']);
    $student = User::factory()->create(['role' => 'student']);
    User::factory()->unverified()->create(['role' => 'teacher']);
    Follow::create(['follower_id' => $student->id, 'followed_id' => $teacher->id]);
    Connection::create([
        'requester_id' => $teacher->id, 'addressee_id' => $student->id,
        'status' => 'accepted', 'pair_key' => Connection::pairKey($teacher->id, $student->id),
    ]);

    $this->actingAs($admin);
    $metrics = $this->get('/dashboard')->viewData('page')['props']['metrics'];

    expect($metrics['users_by_role']['teacher'])->toBe(2)
        ->and($metrics['users_by_role']['student'])->toBe(1)
        ->and($metrics['users_by_role']['admin'])->toBe(1)
        ->and($metrics['verified_percentage'])->toBe(75)
        ->and($metrics['follows'])->toBe(1)
        ->and($metrics['connections'])->toBe(1);
});

test('a non-admin gets no metrics at all', function () {
    // Null rather than zeroes: a teacher must not learn the platform's user
    // counts from a prop the page simply chose not to render.
    $this->actingAs(User::factory()->create(['role' => 'teacher']));

    expect($this->get('/dashboard')->viewData('page')['props']['metrics'])->toBeNull();
});
