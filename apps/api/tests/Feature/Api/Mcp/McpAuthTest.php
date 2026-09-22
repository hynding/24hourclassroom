<?php

use App\Enums\Role;
use App\Models\Test;
use App\Models\User;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('an mcp token is refused on every session-only json route', function () {
    // Sanctum's auth:sanctum accepts a personal token on every route it
    // guards. Without `session-only` a stolen MCP token would drive the
    // whole JSON API, so each of these three registrations is asserted.
    $teacher = aTeacher(['email_verified_at' => now()]);
    $token = mcpToken($teacher);

    $this->withToken($token)->getJson('/api/user')->assertStatus(401);
    $this->withToken($token)->getJson('/api/materials')->assertStatus(401);
    $this->withToken($token)->postJson('/api/auth/verification-notification')->assertStatus(401);

    // The same teacher's session still works on all three.
    $this->flushHeaders();
    $this->withHeader('Referer', 'http://localhost:3333');
    $this->actingAs($teacher);
    $this->getJson('/api/user')->assertOk();
    $this->getJson('/api/materials')->assertOk();
});

test('a bearer token is a guest on the public library and the payload is byte-identical to an anonymous request', function () {
    config(['app.debug' => false]);

    // The public group carries no auth:sanctum and only the session guard
    // exists there, so a bearer request is simply a GUEST -- there is
    // nothing for `session-only` to reject. Assert the guest payload rather
    // than a status: a viewer-dependent field appearing here later would be
    // a leak a status check would miss.
    $teacher = aTeacher(['email_verified_at' => now()]);
    $public = Test::factory()->for($teacher, 'author')->published()->create(['title' => 'Published fractions']);
    Test::factory()->for($teacher, 'author')->create(['title' => 'Private draft']);

    $withToken = $this->withToken(mcpToken($teacher))->getJson('/api/library')->assertOk();
    $withToken->assertJsonPath('data.0.id', $public->id)
        ->assertJsonCount(1, 'data')
        ->assertJsonMissing(['title' => 'Private draft']);

    $this->flushHeaders();
    $this->withHeader('Referer', 'http://localhost:3333');
    $anonymous = $this->getJson('/api/library')->assertOk();

    expect($withToken->getContent())->toBe($anonymous->getContent());
});
