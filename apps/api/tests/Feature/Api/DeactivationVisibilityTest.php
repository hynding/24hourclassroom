<?php

use App\Models\Connection;
use App\Models\Profile;
use App\Models\User;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('the directory excludes deactivated teachers but keeps active ones', function () {
    $active = User::factory()->create(['role' => 'teacher', 'name' => 'Active Ada']);
    Profile::factory()->for($active)->create();
    $gone = User::factory()->create(['role' => 'teacher', 'name' => 'Gone Grace', 'deactivated_at' => now()]);
    Profile::factory()->for($gone)->create();

    $ids = collect($this->getJson('/api/teachers')->assertOk()->json('data'))->pluck('id')->all();

    expect($ids)->toBe([$active->id]);
});

test('a deactivated teachers profile is 404, indistinguishable from a student', function () {
    $gone = User::factory()->create(['role' => 'teacher', 'deactivated_at' => now()]);

    $this->getJson("/api/users/{$gone->id}")->assertStatus(404);
});

test('connection lists exclude a deactivated counterpart but keep active ones', function () {
    $me = User::factory()->create(['role' => 'teacher']);
    $activePeer = User::factory()->create(['role' => 'teacher']);
    $gonePeer = User::factory()->create(['role' => 'teacher']);

    foreach ([$activePeer, $gonePeer] as $peer) {
        $this->actingAs($me);
        $this->postJson("/api/connections/{$peer->id}");
        $this->actingAs($peer);
        $this->patchJson('/api/connections/'.Connection::where('addressee_id', $peer->id)->firstOrFail()->id);
    }

    // `update()` would silently no-op: `deactivated_at` is deliberately
    // excluded from User::$fillable, so mass-assignment on an already
    // persisted model drops it. `forceFill()` bypasses that guard the way
    // an admin-deactivation action would.
    $gonePeer->forceFill(['deactivated_at' => now()])->save();

    $this->actingAs($me);
    $ids = collect($this->getJson('/api/connections')->assertOk()->json('data'))->pluck('user.id')->all();

    // The row survives (reactivation restores the graph) -- it is only hidden.
    expect($ids)->toBe([$activePeer->id])
        ->and(Connection::count())->toBe(2);
});

test('pending lists exclude a deactivated counterpart', function () {
    $me = User::factory()->create(['role' => 'teacher']);
    $gone = User::factory()->create(['role' => 'teacher']);
    $this->actingAs($me);
    $this->postJson("/api/connections/{$gone->id}");
    // See the comment above: update() would silently no-op on this guarded column.
    $gone->forceFill(['deactivated_at' => now()])->save();

    $body = $this->getJson('/api/connections/pending')->assertOk()->json();

    expect($body['outgoing'])->toBe([]);
});
