<?php

use App\Models\Connection;
use App\Models\User;
use App\Notifications\ConnectionAccepted;
use App\Notifications\ConnectionRequested;
use App\Notifications\NewFollower;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('following notifies the followed teacher and nobody else', function () {
    $follower = User::factory()->create(['name' => 'Ada']);
    $teacher = User::factory()->create(['role' => 'teacher']);
    $bystander = User::factory()->create(['role' => 'teacher']);
    $this->actingAs($follower);

    $this->postJson("/api/users/{$teacher->id}/follow")->assertNoContent();

    expect($teacher->notifications()->count())->toBe(1)
        ->and($teacher->notifications()->first()->type)->toBe(NewFollower::class)
        ->and($teacher->notifications()->first()->data['user']['name'])->toBe('Ada')
        ->and($bystander->notifications()->count())->toBe(0)
        ->and($follower->notifications()->count())->toBe(0);
});

test('unfollowing notifies nobody', function () {
    $follower = User::factory()->create();
    $teacher = User::factory()->create(['role' => 'teacher']);
    $this->actingAs($follower);
    $this->postJson("/api/users/{$teacher->id}/follow");

    $this->deleteJson("/api/users/{$teacher->id}/follow")->assertNoContent();

    // Still exactly the one from the follow -- a withdrawal is not news.
    expect($teacher->notifications()->count())->toBe(1);
});

test('a connection request notifies the addressee, and accepting notifies the requester', function () {
    $requester = User::factory()->create(['role' => 'teacher']);
    $addressee = User::factory()->create(['role' => 'teacher']);

    $this->actingAs($requester);
    $this->postJson("/api/connections/{$addressee->id}")->assertNoContent();

    expect($addressee->notifications()->count())->toBe(1)
        ->and($addressee->notifications()->first()->type)->toBe(ConnectionRequested::class)
        ->and($requester->notifications()->count())->toBe(0);

    $this->actingAs($addressee);
    $this->patchJson('/api/connections/'.Connection::firstOrFail()->id)->assertNoContent();

    expect($requester->notifications()->count())->toBe(1)
        ->and($requester->notifications()->first()->type)->toBe(ConnectionAccepted::class)
        // The addressee is not told about their own acceptance.
        ->and($addressee->notifications()->count())->toBe(1);
});

test('declining notifies nobody', function () {
    $requester = User::factory()->create(['role' => 'teacher']);
    $addressee = User::factory()->create(['role' => 'teacher']);
    $this->actingAs($requester);
    $this->postJson("/api/connections/{$addressee->id}");

    $this->actingAs($addressee);
    $this->deleteJson('/api/connections/'.Connection::firstOrFail()->id)->assertNoContent();

    expect($requester->notifications()->count())->toBe(0);
});

test('the index lists only the callers notifications, newest first', function () {
    $me = User::factory()->create(['role' => 'teacher']);
    $other = User::factory()->create(['role' => 'teacher']);
    $me->notify(new NewFollower(User::factory()->create(['name' => 'First'])));
    $me->notify(new NewFollower(User::factory()->create(['name' => 'Second'])));
    $other->notify(new NewFollower(User::factory()->create(['name' => 'NotMine'])));

    $this->actingAs($me);
    $names = collect($this->getJson('/api/notifications')->assertOk()->json('data'))
        ->pluck('data.user.name')->all();

    expect($names)->toBe(['Second', 'First']);
});

test('the unread count reflects only the callers unread notifications', function () {
    $me = User::factory()->create(['role' => 'teacher']);
    $other = User::factory()->create(['role' => 'teacher']);
    $me->notify(new NewFollower(User::factory()->create()));
    $other->notify(new NewFollower(User::factory()->create()));
    $other->notify(new NewFollower(User::factory()->create()));

    $this->actingAs($me);

    $this->getJson('/api/notifications/unread-count')->assertOk()->assertExactJson(['count' => 1]);
});

test('marking read clears the callers unread count', function () {
    $me = User::factory()->create(['role' => 'teacher']);
    $me->notify(new NewFollower(User::factory()->create()));
    $this->actingAs($me);

    $this->postJson('/api/notifications/read')->assertNoContent();

    $this->getJson('/api/notifications/unread-count')->assertExactJson(['count' => 0]);
});

test('marking read ignores ids belonging to someone else', function () {
    $me = User::factory()->create(['role' => 'teacher']);
    $other = User::factory()->create(['role' => 'teacher']);
    $other->notify(new NewFollower(User::factory()->create()));
    $theirId = $other->notifications()->first()->id;
    $this->actingAs($me);

    // Silently ignored rather than 403/404 -- either would confirm the id
    // exists. The other user's notification must remain unread.
    $this->postJson('/api/notifications/read', ['ids' => [$theirId]])->assertNoContent();

    expect($other->unreadNotifications()->count())->toBe(1);
});

test('marking read with explicit ids marks those and leaves the rest unread', function () {
    $me = User::factory()->create(['role' => 'teacher']);
    $me->notify(new NewFollower(User::factory()->create()));
    $me->notify(new NewFollower(User::factory()->create()));
    $first = $me->notifications()->latest()->first()->id;
    $this->actingAs($me);

    $this->postJson('/api/notifications/read', ['ids' => [$first]])->assertNoContent();

    expect($me->unreadNotifications()->count())->toBe(1);
});

test('a guest cannot read notifications', function () {
    $this->getJson('/api/notifications')->assertStatus(401);
});

test('the index returns the same paginated envelope /api/teachers returns', function () {
    // Regression for the cross-layer defect where every mock asserted a `meta`
    // key the server never sent. Asserted against the real endpoint, not a
    // fixture: `meta.last_page` is what page-notifications reads, and a flat
    // paginator puts `last_page` at the top level instead.
    $me = User::factory()->create(['role' => 'teacher']);
    $me->notify(new NewFollower(User::factory()->create(['name' => 'Ada'])));
    $this->actingAs($me);

    $response = $this->getJson('/api/notifications')->assertOk();

    $response->assertJsonStructure([
        'data' => [['id', 'type', 'read_at', 'created_at', 'data']],
        'meta' => ['current_page', 'last_page', 'per_page', 'total'],
    ]);

    // The flat shape must be gone, not merely accompanied by a nested one --
    // both present would let the next reader pick the wrong key again.
    expect($response->json())->not->toHaveKey('last_page')
        ->and($response->json())->not->toHaveKey('current_page')
        ->and($response->json('meta.last_page'))->toBe(1)
        ->and($response->json('meta.total'))->toBe(1);

    // The row itself carries only the keys @24hc/shared's AppNotification
    // declares -- notifiable_id/notifiable_type/sequence are internals.
    expect(array_keys($response->json('data.0')))
        ->toBe(['id', 'type', 'read_at', 'created_at', 'data']);
});

test('the index paginates at 15 and reports the real last page', function () {
    // Proves meta.last_page is computed rather than hard-coded to 1: the page
    // component's Next button is driven entirely by this number.
    $me = User::factory()->create(['role' => 'teacher']);
    foreach (range(1, 16) as $i) {
        $me->notify(new NewFollower(User::factory()->create(['name' => "F{$i}"])));
    }
    $this->actingAs($me);

    $first = $this->getJson('/api/notifications')->assertOk();
    expect($first->json('meta.last_page'))->toBe(2)
        ->and($first->json('meta.current_page'))->toBe(1)
        ->and($first->json('data'))->toHaveCount(15);

    $second = $this->getJson('/api/notifications?page=2')->assertOk();
    expect($second->json('meta.current_page'))->toBe(2)
        ->and($second->json('data'))->toHaveCount(1)
        ->and($second->json('data.0.data.user.name'))->toBe('F1');
});
