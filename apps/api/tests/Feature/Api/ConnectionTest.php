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

test('students cannot connect to each other, and get 404 rather than a 422 that names the reason', function () {
    // The 422 was an enumeration oracle: walk the id space as a student and
    // every "Students cannot connect with each other." confirms an existing
    // student account, reconstructing the directory the spec deliberately
    // omits. Decision 5's "404, never 403" outranks the spec's endpoint
    // table here, and FollowController already made the same call.
    config(['app.debug' => false]);

    $s1 = student();
    $s2 = student();
    $this->actingAs($s1);

    $response = $this->postJson("/api/connections/{$s2->id}");
    $missing = $this->postJson('/api/connections/999999');

    expect($response->status())->toBe(404)
        ->and($response->status())->toBe($missing->status())
        ->and($response->json())->toBe($missing->json());

    $this->assertDatabaseCount('connections', 0);
});

test('a teacher may still connect with a student', function () {
    // The 404 is scoped to a student caller: a teacher reaching a student is
    // the normal path and must keep working.
    $t = teacher();
    $s = student();
    $this->actingAs($t);

    $this->postJson("/api/connections/{$s->id}")->assertNoContent();

    $this->assertDatabaseCount('connections', 1);
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

test('an outgoing pending request to a student discloses the id and nothing else', function () {
    // GET /api/users/{student} is 404 to anyone without an ACCEPTED
    // connection, but pending() handed back the full UserSummary for a person
    // who had agreed to nothing. Three requests -- 404, POST, read the list --
    // and an unthrottled teacher harvests every student's name and avatar.
    $me = teacher();
    $s = student();
    $s->profile()->create(['bio' => null]);
    $s->profile->forceFill(['avatar_path' => 'avatars/secret.png'])->save();
    $this->actingAs($me);

    $this->getJson("/api/users/{$s->id}")->assertStatus(404);
    $this->postJson("/api/connections/{$s->id}")->assertNoContent();

    $outgoing = $this->getJson('/api/connections/pending')->assertOk()->json('outgoing');

    expect($outgoing)->toHaveCount(1)
        ->and($outgoing[0]['user'])->toBe(['id' => $s->id]);
});

test('an outgoing pending request to a teacher still carries the full summary', function () {
    // The exclusion above must be scoped to students, not applied to every
    // outgoing row: teachers are publicly discoverable by design.
    $me = teacher();
    $t = teacher();
    $t->forceFill(['name' => 'Open Olly'])->save();
    $t->profile()->create(['bio' => null]);
    $t->profile->forceFill(['avatar_path' => 'avatars/public.png'])->save();
    $this->actingAs($me);
    $this->postJson("/api/connections/{$t->id}")->assertNoContent();

    $outgoing = $this->getJson('/api/connections/pending')->assertOk()->json('outgoing');

    expect($outgoing[0]['user']['id'])->toBe($t->id)
        ->and($outgoing[0]['user']['name'])->toBe('Open Olly')
        ->and($outgoing[0]['user']['avatar_url'])->toContain('avatars/public.png');
});

test('an incoming pending request from a student still names the student', function () {
    // The addressee has to know who is asking in order to decide. The leak
    // was the outgoing direction, where the counterpart never opted in.
    $me = teacher();
    $s = student();
    $s->forceFill(['name' => 'Asking Amy'])->save();

    $this->actingAs($s);
    $this->postJson("/api/connections/{$me->id}")->assertNoContent();

    $this->actingAs($me);
    $incoming = $this->getJson('/api/connections/pending')->assertOk()->json('incoming');

    expect($incoming[0]['user']['name'])->toBe('Asking Amy');
});

test('an accepted student connection is named in the connections list', function () {
    // Decision 5's line: identity is revealed to an ACCEPTED connection. The
    // pending redaction must not survive acceptance.
    $me = teacher();
    $s = student();
    $s->forceFill(['name' => 'Accepted Ash'])->save();
    $this->actingAs($me);
    $this->postJson("/api/connections/{$s->id}");

    $this->actingAs($s);
    $this->patchJson('/api/connections/'.Connection::firstOrFail()->id)->assertNoContent();

    $this->actingAs($me);
    $data = $this->getJson('/api/connections')->assertOk()->json('data');

    expect($data[0]['user']['name'])->toBe('Accepted Ash');
});

test('a deactivated target cannot be connected with and 404s like a nonexistent id', function () {
    // 204 here created a pending row that pending() then filtered out, so the
    // requester could neither see nor cancel it while every retry answered
    // 422 "already exists" -- a row no UI can clear. The 204-vs-404 split was
    // also an oracle for the set of deactivated accounts.
    config(['app.debug' => false]);

    $me = teacher();
    $deactivated = User::factory()->create(['role' => 'teacher', 'deactivated_at' => now()]);
    $this->actingAs($me);

    $response = $this->postJson("/api/connections/{$deactivated->id}");
    $missing = $this->postJson('/api/connections/999999');

    expect($response->status())->toBe(404)
        ->and($response->status())->toBe($missing->status())
        ->and($response->json())->toBe($missing->json());

    $this->assertDatabaseCount('connections', 0);
    expect($deactivated->notifications()->count())->toBe(0);
});

test('a deactivated student target 404s too, not 422', function () {
    // Reached as a student caller, so the student-student branch would
    // otherwise answer first and leak the target's role.
    config(['app.debug' => false]);

    $me = student();
    $deactivated = User::factory()->create(['role' => 'student', 'deactivated_at' => now()]);
    $this->actingAs($me);

    $response = $this->postJson("/api/connections/{$deactivated->id}");
    $missing = $this->postJson('/api/connections/999999');

    expect($response->status())->toBe($missing->status())
        ->and($response->json())->toBe($missing->json());

    $this->assertDatabaseCount('connections', 0);
});

test('an active target can still be connected with', function () {
    // Counter-test for the isActive() guard.
    $me = teacher();
    $live = User::factory()->create(['role' => 'teacher', 'deactivated_at' => null]);
    $this->actingAs($me);

    $this->postJson("/api/connections/{$live->id}")->assertNoContent();

    $this->assertDatabaseCount('connections', 1);
});

test('accepting twice is idempotent in side effects, not just in status', function () {
    // update() wrote Accepted unconditionally and then always notified, so a
    // double-tap on Accept -- or a second click racing the reload accept()
    // triggers -- delivered two "X accepted your request" notifications and
    // bumped the unread badge twice for one event. Follow guards its notify
    // with wasRecentlyCreated; connect had no equivalent. With no throttle on
    // the authenticated API group, an addressee could fill a requester's feed.
    $requester = teacher();
    $addressee = teacher();
    $this->actingAs($requester);
    $this->postJson("/api/connections/{$addressee->id}")->assertNoContent();
    $connection = Connection::firstOrFail();

    $this->actingAs($addressee);
    $this->patchJson("/api/connections/{$connection->id}")->assertNoContent();

    // The first accept must still notify -- otherwise this test would pass
    // with the notify removed entirely.
    expect($requester->notifications()->count())->toBe(1);

    // Idempotent 204 stays (spec line 62); only the side effect is guarded.
    $this->patchJson("/api/connections/{$connection->id}")->assertNoContent();
    $this->patchJson("/api/connections/{$connection->id}")->assertNoContent();

    expect($requester->notifications()->count())->toBe(1)
        ->and($connection->fresh()->status->value)->toBe('accepted');
});
