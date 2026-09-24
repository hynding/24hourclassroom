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

    // The integration routes mint and revoke MCP tokens themselves -- a
    // stolen MCP token reaching them would let it mint or revoke its own
    // siblings.
    $this->withToken($token)->getJson('/api/integrations')->assertStatus(401);
    $this->withToken($token)->postJson('/api/integrations/mcp-tokens', ['name' => 'x'])->assertStatus(401);
    $this->withToken($token)->deleteJson('/api/integrations/mcp-tokens/1')->assertStatus(401);
    $this->withToken($token)->putJson('/api/integrations/anthropic-key', ['api_key' => str_repeat('k', 30)])->assertStatus(401);
    $this->withToken($token)->deleteJson('/api/integrations/anthropic-key')->assertStatus(401);
    $this->withToken($token)->getJson('/api/generations')->assertStatus(401);
    $this->withToken($token)->getJson('/api/generations/1')->assertStatus(401);
    $this->withToken($token)->postJson('/api/generations', [])->assertStatus(401);
    // A non-existent id, on purpose: proves session-only is refused before
    // route-model binding runs, not after -- otherwise a stolen MCP token
    // could walk every id space by reading 404 (missing) vs 401 (exists) off
    // a bound route's response.
    $this->withToken($token)->postJson('/api/generations/1/cancel')->assertStatus(401);
    $this->withToken($token)->putJson('/api/materials/999999', [])->assertStatus(401);

    // Nothing was minted, nothing was revoked.
    expect($teacher->tokens()->count())->toBe(1);

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

test('an mcp token from a verified active teacher reaches the server', function () {
    $teacher = aTeacher(['email_verified_at' => now()]);

    $this->withToken(mcpToken($teacher))
        ->postJson('/mcp/teacher', mcpPing())
        ->assertOk()
        ->assertJsonPath('jsonrpc', '2.0')
        ->assertJsonPath('id', 1);
});

test('a token without the mcp ability is refused', function () {
    $teacher = aTeacher(['email_verified_at' => now()]);
    $other = $teacher->createToken('Something else', ['other'])->plainTextToken;

    $this->withToken($other)->postJson('/mcp/teacher', mcpPing())->assertStatus(403);
});

test('a session without a token is refused at the mcp route', function () {
    // auth:sanctum falls back to the session guard, which hands the request
    // a TransientToken whose can() is unconditionally true -- abilities:mcp
    // alone would let a logged-in browser tab in.
    $this->actingAs(aTeacher(['email_verified_at' => now()]));

    $this->postJson('/mcp/teacher', mcpPing())->assertStatus(401);
});

test('every non-teacher role is refused at the mcp route', function () {
    foreach (Role::cases() as $role) {
        if ($role === Role::Teacher) {
            continue;
        }

        $user = User::factory()->create(['role' => $role->value, 'email_verified_at' => now()]);

        // Sanctum's RequestGuard caches the resolved user on the guard
        // instance for the whole test, so each loop iteration's new bearer
        // identity needs the cache dropped or later roles silently reuse it.
        $this->app['auth']->forgetGuards();

        $this->flushHeaders();
        $this->withHeader('Referer', 'http://localhost:3333');
        $this->withToken(mcpToken($user))
            ->postJson('/mcp/teacher', mcpPing())
            ->assertStatus(403);
    }
});

test('a deactivated teacher gets 401 and an unverified teacher gets 403', function () {
    // `active` is ahead of `teacher` in the priority list, so a deactivated
    // user gets the status `active` gives a JSON request everywhere else.
    $deactivated = aTeacher(['email_verified_at' => now(), 'deactivated_at' => now()]);
    $this->withToken(mcpToken($deactivated))->postJson('/mcp/teacher', mcpPing())->assertStatus(401);

    // Sanctum's RequestGuard caches the resolved user on the guard instance,
    // and the AuthManager singleton keeps that instance for the whole test,
    // so a second bearer identity would otherwise resolve to the first user.
    $this->app['auth']->forgetGuards();

    $unverified = aTeacher(['email_verified_at' => null]);
    $this->flushHeaders();
    $this->withHeader('Referer', 'http://localhost:3333');
    $this->withToken(mcpToken($unverified))->postJson('/mcp/teacher', mcpPing())->assertStatus(403);
});

test('the mcp limiter is keyed on the token, not on the host or the user', function () {
    $first = aTeacher(['email_verified_at' => now()]);
    $second = aTeacher(['email_verified_at' => now()]);
    $firstToken = mcpToken($first);

    foreach (range(1, 60) as $i) {
        $this->withToken($firstToken)->postJson('/mcp/teacher', mcpPing())->assertOk();
    }
    $this->withToken($firstToken)->postJson('/mcp/teacher', mcpPing())->assertStatus(429);

    // Same guard-instance caching as above: the second teacher is a new
    // bearer identity, so the cached resolution from $first must be dropped.
    $this->app['auth']->forgetGuards();

    // Same host, different token: a global or ip-keyed limiter would make
    // one teacher's client a denial-of-service primitive against everyone.
    $this->withToken(mcpToken($second))->postJson('/mcp/teacher', mcpPing())->assertOk();

    // And the exhausted teacher's OWN session still has its separate
    // throttle:60,1 budget on the JSON API -- the two buckets are distinct.
    $this->flushHeaders();
    $this->withHeader('Referer', 'http://localhost:3333');
    $this->actingAs($first);
    $this->getJson('/api/tests')->assertOk();
});

test('a rejected mcp request advertises bearer auth', function () {
    // The package's AddWwwAuthenticateHeader turns every 401 on this route
    // into a discoverable challenge, which is how a client knows to send a
    // token rather than a cookie.
    $response = $this->postJson('/mcp/teacher', mcpPing())->assertStatus(401);

    expect($response->headers->get('WWW-Authenticate'))->toStartWith('Bearer realm="mcp"');
});
