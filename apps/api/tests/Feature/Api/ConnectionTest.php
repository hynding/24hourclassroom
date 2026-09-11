<?php

use App\Models\Connection;
use App\Models\User;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

function teacher(): User
{
    return User::factory()->create(['role' => 'teacher']);
}

function student(): User
{
    return User::factory()->create(['role' => 'student']);
}

test('a teacher requests a connection and the addressee accepts it', function () {
    $a = teacher();
    $b = teacher();
    $this->actingAs($a);
    $this->postJson("/api/connections/{$b->id}")->assertNoContent();

    $connection = Connection::firstOrFail();
    expect($connection->status->value)->toBe('pending');

    $this->actingAs($b);
    $this->patchJson("/api/connections/{$connection->id}")->assertNoContent();

    expect($connection->fresh()->status->value)->toBe('accepted');
});

test('the requester cannot accept their own request', function () {
    $a = teacher();
    $b = teacher();
    $this->actingAs($a);
    $this->postJson("/api/connections/{$b->id}");
    $connection = Connection::firstOrFail();

    // 403 not 404: the requester is a party to the row and already knows it
    // exists, so there is nothing to leak.
    $this->patchJson("/api/connections/{$connection->id}")->assertStatus(403);

    expect($connection->fresh()->status->value)->toBe('pending');
});

test('a third party gets 404, not 403, for someone elses connection', function () {
    $a = teacher();
    $b = teacher();
    $this->actingAs($a);
    $this->postJson("/api/connections/{$b->id}");
    $connection = Connection::firstOrFail();

    $this->actingAs(teacher());
    $this->patchJson("/api/connections/{$connection->id}")->assertStatus(404);
    $this->deleteJson("/api/connections/{$connection->id}")->assertStatus(404);

    expect($connection->fresh())->not->toBeNull();
});

test('students cannot connect to each other', function () {
    $s1 = student();
    $s2 = student();
    $this->actingAs($s1);

    $this->postJson("/api/connections/{$s2->id}")
        ->assertStatus(422)->assertJsonValidationErrors('user');

    $this->assertDatabaseCount('connections', 0);
});

test('a teacher and a student may connect in either direction', function () {
    // Proves the student-student rule rejects only that pairing rather than
    // rejecting every request involving a student.
    $t = teacher();
    $s = student();

    $this->actingAs($t);
    $this->postJson("/api/connections/{$s->id}")->assertNoContent();

    $t2 = teacher();
    $this->actingAs($s);
    $this->postJson("/api/connections/{$t2->id}")->assertNoContent();

    expect(Connection::count())->toBe(2);
});

test('a duplicate request is rejected in either direction', function () {
    $a = teacher();
    $b = teacher();

    $this->actingAs($a);
    $this->postJson("/api/connections/{$b->id}")->assertNoContent();
    $this->postJson("/api/connections/{$b->id}")->assertStatus(422);

    $this->actingAs($b);
    $this->postJson("/api/connections/{$a->id}")->assertStatus(422);

    expect(Connection::count())->toBe(1);
});

test('a user cannot connect to themselves', function () {
    $a = teacher();
    $this->actingAs($a);

    $this->postJson("/api/connections/{$a->id}")
        ->assertStatus(422)->assertJsonValidationErrors('user');
});

test('either party can disconnect', function () {
    $a = teacher();
    $b = teacher();
    $this->actingAs($a);
    $this->postJson("/api/connections/{$b->id}");
    $connection = Connection::firstOrFail();

    $this->actingAs($b);
    $this->deleteJson("/api/connections/{$connection->id}")->assertNoContent();

    $this->assertDatabaseCount('connections', 0);
});

test('the connections list returns accepted connections only, by id', function () {
    $me = teacher();
    $accepted = teacher();
    $pendingOnly = teacher();

    $this->actingAs($me);
    $this->postJson("/api/connections/{$accepted->id}");
    $this->postJson("/api/connections/{$pendingOnly->id}");

    $this->actingAs($accepted);
    $this->patchJson('/api/connections/'.Connection::where('addressee_id', $accepted->id)->firstOrFail()->id);

    $this->actingAs($me);
    $ids = collect($this->getJson('/api/connections')->assertOk()->json('data'))->pluck('user.id')->all();

    // Asserting ids, not a count: a count of 1 would pass even if the wrong
    // connection came back.
    expect($ids)->toBe([$accepted->id]);
});

test('pending separates incoming from outgoing', function () {
    $me = teacher();
    $iAsked = teacher();
    $askedMe = teacher();

    $this->actingAs($me);
    $this->postJson("/api/connections/{$iAsked->id}");
    $this->actingAs($askedMe);
    $this->postJson("/api/connections/{$me->id}");

    $this->actingAs($me);
    $body = $this->getJson('/api/connections/pending')->assertOk()->json();

    expect(collect($body['incoming'])->pluck('user.id')->all())->toBe([$askedMe->id])
        ->and(collect($body['outgoing'])->pluck('user.id')->all())->toBe([$iAsked->id]);
});

test('an unverified user cannot request a connection', function () {
    $this->actingAs(User::factory()->unverified()->create(['role' => 'teacher']));

    $this->postJson('/api/connections/'.teacher()->id)->assertStatus(403);
});
