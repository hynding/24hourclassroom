<?php

use App\Models\User;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('the authenticated api group is throttled at 60 a minute, the same limit the public group already carries', function () {
    // There was no throttle on this group at all, which is why every
    // enumeration sweep in this review ran at full speed -- and each
    // POST /api/connections/{id} probe wrote a row and fired a notification,
    // so the census doubled as inbox spam. 60,1 is not a new number: it is
    // the limit the public group in the same file uses.
    $this->actingAs(User::factory()->create(['role' => 'teacher']));

    foreach (range(1, 60) as $i) {
        $this->getJson('/api/connections')->assertOk();
    }

    $this->getJson('/api/connections')->assertStatus(429);
});

test('the throttle covers the write endpoints the enumeration sweeps used, not just the reads', function () {
    // The oracle was POST /api/connections/{id}. Exhausting the budget with
    // reads must close the writes too, or the cap is decorative.
    $me = User::factory()->create(['role' => 'teacher']);
    $target = User::factory()->create(['role' => 'teacher']);
    $this->actingAs($me);

    foreach (range(1, 60) as $i) {
        $this->getJson('/api/connections')->assertOk();
    }

    $this->postJson("/api/connections/{$target->id}")->assertStatus(429);
    $this->assertDatabaseCount('connections', 0);
});

test('the throttle is per user, so one attacker cannot lock everyone else out', function () {
    // The counter-test. A global limiter would make this a denial-of-service
    // primitive instead of a fix, and would also make the tests above pass.
    $attacker = User::factory()->create(['role' => 'teacher']);
    $this->actingAs($attacker);

    foreach (range(1, 60) as $i) {
        $this->getJson('/api/connections')->assertOk();
    }
    $this->getJson('/api/connections')->assertStatus(429);

    $this->actingAs(User::factory()->create(['role' => 'teacher']));
    $this->getJson('/api/connections')->assertOk();
});

test('an ordinary page load is nowhere near the cap', function () {
    // The SPA's heaviest navigation is /notifications: list, mark-read, then
    // the header's unread refetch. Asserting the real budget rather than
    // trusting the arithmetic -- 15 of those in a minute is far past any
    // human pace and still leaves headroom under the cap.
    $this->actingAs(User::factory()->create(['role' => 'teacher']));

    foreach (range(1, 15) as $i) {
        $this->getJson('/api/notifications')->assertOk();
        $this->postJson('/api/notifications/read')->assertNoContent();
        $this->getJson('/api/notifications/unread-count')->assertOk();
    }
});

test('the authenticated and public groups share one per-user budget', function () {
    // Documented, not merely observed: both groups use `throttle:60,1` and
    // ThrottleRequests keys an authenticated request on the user id alone, so
    // the two carry the SAME limiter key. A signed-in user therefore has one
    // 60/minute budget across the directory and the authenticated endpoints,
    // not two. Recorded here so the next person to tune either number knows
    // they are tuning both.
    $this->actingAs(User::factory()->create(['role' => 'teacher']));

    foreach (range(1, 60) as $i) {
        $this->getJson('/api/connections')->assertOk();
    }

    $this->getJson('/api/teachers')->assertStatus(429);
});
