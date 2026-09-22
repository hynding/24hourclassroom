<?php

use App\Enums\Role;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('the integrations payload lists no tokens and a placeholder anthropic block', function () {
    $this->actingAs(aTeacher(['email_verified_at' => now()]));

    // PLAN 2 REWRITES THIS ASSERTION: the `anthropic` block is hard-coded
    // here because the `integrations` table is plan 2's. The KEY SHAPE is
    // final -- plan 2 only changes where the three values come from.
    $this->getJson('/api/integrations')->assertOk()->assertExactJson([
        'mcp_tokens' => [],
        'anthropic' => ['configured' => false, 'hint' => null, 'verified_at' => null],
    ]);
});

test('minting a token returns the plaintext once and stores the mcp ability', function () {
    $teacher = aTeacher(['email_verified_at' => now()]);
    $this->actingAs($teacher);

    $response = $this->postJson('/api/integrations/mcp-tokens', ['name' => 'Claude Code'])
        ->assertCreated()
        ->assertJsonPath('name', 'Claude Code')
        ->assertJsonStructure(['id', 'name', 'token']);

    $plain = $response->json('token');
    $row = PersonalAccessToken::findToken($plain);

    expect($row)->not->toBeNull();
    expect($row->abilities)->toBe(['mcp']);
    expect($row->expires_at)->toBeNull();
    expect($row->tokenable_id)->toBe($teacher->id);

    // The plaintext is never recoverable: only its hash is stored.
    expect($row->token)->not->toBe($plain);

    // And it works at the MCP route.
    $this->flushHeaders();
    // The guard caches the acting user for the whole test; drop it so the bearer token is what authenticates.
    $this->app['auth']->forgetGuards();
    $this->withToken($plain)->postJson('/mcp/teacher', mcpPing())->assertOk();
});

test('the token list carries no secret material', function () {
    $teacher = aTeacher(['email_verified_at' => now()]);
    $plain = mcpToken($teacher, 'Laptop');
    $this->actingAs($teacher);

    $response = $this->getJson('/api/integrations')->assertOk()
        ->assertJsonCount(1, 'mcp_tokens')
        ->assertJsonPath('mcp_tokens.0.name', 'Laptop')
        ->assertJsonPath('mcp_tokens.0.last_used_at', null);

    expect(array_keys($response->json('mcp_tokens.0')))
        ->toBe(['id', 'name', 'last_used_at', 'created_at']);
    expect($response->getContent())
        ->not->toContain(explode('|', $plain)[1])
        ->not->toContain(hash('sha256', explode('|', $plain)[1]));
});

test('a sixth token is refused with a sentence about revoking', function () {
    $teacher = aTeacher(['email_verified_at' => now()]);
    $this->actingAs($teacher);

    foreach (range(1, 5) as $i) {
        $this->postJson('/api/integrations/mcp-tokens', ['name' => "Client {$i}"])->assertCreated();
    }

    $this->postJson('/api/integrations/mcp-tokens', ['name' => 'Client 6'])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['name' => 'Revoke a token first.']);

    expect($teacher->tokens()->count())->toBe(5);
});

test('revoking a token removes its access to the mcp server', function () {
    $teacher = aTeacher(['email_verified_at' => now()]);
    $plain = mcpToken($teacher);
    $id = PersonalAccessToken::findToken($plain)->id;
    $this->actingAs($teacher);

    $this->deleteJson("/api/integrations/mcp-tokens/{$id}")->assertNoContent();
    expect($teacher->tokens()->count())->toBe(0);

    $this->flushHeaders();
    // The guard caches the acting user for the whole test; drop it so the bearer token is what authenticates.
    $this->app['auth']->forgetGuards();
    $this->withToken($plain)->postJson('/mcp/teacher', mcpPing())->assertStatus(401);
});

test('another teachers token id is indistinguishable from a missing one', function () {
    config(['app.debug' => false]);

    $mine = aTeacher(['email_verified_at' => now()]);
    $theirs = aTeacher(['email_verified_at' => now()]);
    $foreignId = PersonalAccessToken::findToken(mcpToken($theirs))->id;
    $this->actingAs($mine);

    $foreign = $this->deleteJson("/api/integrations/mcp-tokens/{$foreignId}")->assertStatus(404);
    $missing = $this->deleteJson('/api/integrations/mcp-tokens/99999')->assertStatus(404);
    $garbage = $this->deleteJson('/api/integrations/mcp-tokens/not-an-id')->assertStatus(404);

    expect($foreign->getContent())->toBe($missing->getContent())->toBe($garbage->getContent());
    expect($theirs->tokens()->count())->toBe(1);
});

test('every non-teacher role is refused on all three token endpoints', function () {
    foreach (Role::cases() as $role) {
        if ($role === Role::Teacher) {
            continue;
        }

        $user = User::factory()->create(['role' => $role->value, 'email_verified_at' => now()]);
        $this->actingAs($user);

        $this->getJson('/api/integrations')->assertStatus(403);
        $this->postJson('/api/integrations/mcp-tokens', ['name' => 'Nope'])->assertStatus(403);
        $this->deleteJson('/api/integrations/mcp-tokens/1')->assertStatus(403);
    }

    expect(PersonalAccessToken::count())->toBe(0);
});
