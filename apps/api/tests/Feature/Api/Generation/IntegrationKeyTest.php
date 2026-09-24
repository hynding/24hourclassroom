<?php

use App\Ai\Exceptions\AnthropicUnavailable;
use App\Enums\GenerationStatus;
use App\Enums\Role;
use App\Models\Generation;
use App\Models\Integration;
use App\Models\User;
use App\Support\GenerationMessages;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
    $this->fake = fakeAnthropic();
});

test('setting a key verifies it through the gateway, stores it encrypted and returns only the hint', function () {
    $teacher = aTeacher();
    $key = 'sk-ant-api03-abcdefghijklmnop1234';

    $response = $this->actingAs($teacher)
        ->putJson('/api/integrations/anthropic-key', ['api_key' => $key])
        ->assertOk()
        ->assertJsonPath('configured', true)
        ->assertJsonPath('hint', '1234');

    expect($response->json('verified_at'))->not->toBeNull()
        ->and($this->fake->calls['verifyKey'][0][0])->toBe($key)
        // The plaintext is never in a response body.
        ->and($response->getContent())->not->toContain($key);

    $stored = DB::table('integrations')->where('user_id', $teacher->id)->value('anthropic_api_key');
    expect($stored)->not->toBe($key)
        ->and(Integration::forUser($teacher)->apiKey())->toBe($key);
});

test('GET /integrations reports the same anthropic block and never the key', function () {
    $teacher = aTeacher();
    $key = Integration::factory()->create(['user_id' => $teacher->id])->apiKey();

    $response = $this->actingAs($teacher)->getJson('/api/integrations')->assertOk()
        ->assertJsonPath('anthropic.configured', true)
        ->assertJsonPath('anthropic.hint', substr($key, -4))
        ->assertJsonStructure(['mcp_tokens', 'anthropic' => ['configured', 'hint', 'verified_at']]);

    expect($response->getContent())->not->toContain($key);
});

test('a key Anthropic rejects is a 422 on api_key and is not stored', function () {
    $teacher = aTeacher();
    $this->fake->rejectKeys();

    $this->actingAs($teacher)
        ->putJson('/api/integrations/anthropic-key', ['api_key' => 'sk-ant-api03-wrongwrongwrong01'])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['api_key'])
        ->assertJsonPath('errors.api_key.0', GenerationMessages::KEY_REJECTED);

    expect(Integration::forUser($teacher)->hasKey())->toBeFalse();
});

test('an unreachable Anthropic is a 503, not a 422', function () {
    $teacher = aTeacher();
    $this->fake->failNext('verifyKey', new AnthropicUnavailable('down', 503));

    $this->actingAs($teacher)
        ->putJson('/api/integrations/anthropic-key', ['api_key' => 'sk-ant-api03-abcdefghijklmnop1234'])
        ->assertStatus(503)
        ->assertJsonPath('message', GenerationMessages::UNREACHABLE);

    expect(Integration::forUser($teacher)->hasKey())->toBeFalse();
});

test('setting a key clears any provisioning ids left from the previous one', function () {
    $teacher = aTeacher();
    Integration::factory()->create([
        'user_id' => $teacher->id,
        'anthropic_environment_id' => 'env_1',
        'anthropic_agent_id' => 'agent_1',
        'anthropic_agent_version' => 4,
        'anthropic_config_hash' => str_repeat('a', 64),
    ]);

    $this->actingAs($teacher)
        ->putJson('/api/integrations/anthropic-key', ['api_key' => 'sk-ant-api03-abcdefghijklmnop1234'])
        ->assertOk();

    $row = Integration::forUser($teacher);
    expect($row->anthropic_environment_id)->toBeNull()
        ->and($row->anthropic_agent_id)->toBeNull()
        ->and($row->anthropic_agent_version)->toBeNull()
        ->and($row->anthropic_config_hash)->toBeNull();
});

test('replacing a key tears the old organisation down under the OLD key before storing the new one', function () {
    // The new key may belong to a different organisation, which could never
    // reach the old agent, environment or session again.
    $teacher = aTeacher();
    $integration = Integration::factory()->create([
        'user_id' => $teacher->id,
        'anthropic_environment_id' => 'env_1',
        'anthropic_agent_id' => 'agent_1',
        'anthropic_agent_version' => 1,
        'anthropic_config_hash' => str_repeat('a', 64),
    ]);
    $oldKey = $integration->apiKey();

    $generation = Generation::factory()->create([
        'user_id' => $teacher->id,
        'session_id' => 'sesn_1',
        'file_ids' => ['file_1'],
    ]);

    $newKey = 'sk-ant-replacement-key-1234';

    $this->actingAs($teacher)
        ->putJson('/api/integrations/anthropic-key', ['api_key' => $newKey])
        ->assertOk()
        ->assertJsonPath('configured', true)
        ->assertJsonPath('hint', '1234');

    expect($this->fake->calls['verifyKey'][0][0])->toBe($newKey)
        ->and($this->fake->calls['interrupt'][0][0])->toBe($oldKey)
        ->and($this->fake->calls['archiveSession'][0][0])->toBe($oldKey)
        ->and($this->fake->calls['deleteFile'][0])->toBe([$oldKey, 'file_1'])
        ->and($this->fake->calls['archiveAgent'][0])->toBe([$oldKey, 'agent_1'])
        ->and($this->fake->calls['archiveEnvironment'][0])->toBe([$oldKey, 'env_1']);

    $fresh = $generation->fresh();
    expect($fresh->status)->toBe(GenerationStatus::Cancelled)
        ->and($fresh->error)->toBe(GenerationMessages::KEY_REMOVED)
        ->and($fresh->finished_at)->not->toBeNull();

    $row = Integration::forUser($teacher);
    expect($row->apiKey())->toBe($newKey)
        ->and($row->anthropic_agent_id)->toBeNull()
        ->and($row->anthropic_environment_id)->toBeNull()
        ->and($row->anthropic_agent_version)->toBeNull()
        ->and($row->anthropic_config_hash)->toBeNull();
});

test('a key that no longer decrypts reads as not configured', function () {
    $teacher = aTeacher();
    $integration = Integration::factory()->create(['user_id' => $teacher->id]);
    DB::table('integrations')->where('id', $integration->id)->update(['anthropic_api_key' => 'not-a-ciphertext']);

    $this->actingAs($teacher)->getJson('/api/integrations')->assertOk()
        ->assertJsonPath('anthropic.configured', false)
        ->assertJsonPath('anthropic.hint', null)
        ->assertJsonPath('anthropic.verified_at', null);
});

test('removing a key cancels live generations, archives everything and clears the row', function () {
    $teacher = aTeacher();
    $integration = Integration::factory()->create([
        'user_id' => $teacher->id,
        'anthropic_environment_id' => 'env_1',
        'anthropic_agent_id' => 'agent_1',
        'anthropic_agent_version' => 1,
        'anthropic_config_hash' => str_repeat('a', 64),
    ]);
    $key = $integration->apiKey();

    $live = Generation::factory()->create(['user_id' => $teacher->id, 'session_id' => 'sesn_1', 'file_ids' => ['file_1', 'file_2']]);
    $done = Generation::factory()->done()->create(['user_id' => $teacher->id, 'session_id' => 'sesn_2']);

    $this->actingAs($teacher)->deleteJson('/api/integrations/anthropic-key')->assertNoContent();

    expect($this->fake->calls['interrupt'])->toHaveCount(1)
        ->and($this->fake->calls['interrupt'][0])->toBe([$key, 'sesn_1'])
        ->and($this->fake->calls['archiveSession'][0])->toBe([$key, 'sesn_1'])
        ->and($this->fake->calls['deleteFile'])->toHaveCount(2)
        ->and($this->fake->calls['archiveAgent'][0])->toBe([$key, 'agent_1'])
        ->and($this->fake->calls['archiveEnvironment'][0])->toBe([$key, 'env_1']);

    expect($live->fresh()->status)->toBe(GenerationStatus::Cancelled)
        ->and($live->fresh()->error)->toBe(GenerationMessages::KEY_REMOVED)
        // A terminal row is left exactly as it was.
        ->and($done->fresh()->status)->toBe(GenerationStatus::Done)
        ->and($done->fresh()->error)->toBeNull();

    $row = Integration::forUser($teacher);
    expect($row->hasKey())->toBeFalse()
        ->and($row->anthropic_key_hint)->toBeNull()
        ->and($row->anthropic_key_verified_at)->toBeNull()
        ->and($row->anthropic_agent_id)->toBeNull()
        ->and($row->anthropic_environment_id)->toBeNull();
});

test('removing a key skips a generation whose lock is held elsewhere and still tears the rest of the organisation down', function () {
    // NOTE: this test really does take about five seconds -- IntegrationTeardown
    // blocks on the same lock a cancel or the advancer would hold, and gives up
    // rather than racing it.
    $teacher = aTeacher();
    $integration = Integration::factory()->create([
        'user_id' => $teacher->id,
        'anthropic_environment_id' => 'env_1',
        'anthropic_agent_id' => 'agent_1',
        'anthropic_agent_version' => 1,
        'anthropic_config_hash' => str_repeat('a', 64),
    ]);
    $key = $integration->apiKey();

    $busy = Generation::factory()->create(['user_id' => $teacher->id, 'session_id' => 'sesn_1', 'file_ids' => ['file_1']]);

    $lock = Cache::lock($busy->lockKey(), 180);
    expect($lock->get())->toBeTrue();

    Log::spy();

    $this->actingAs($teacher)->deleteJson('/api/integrations/anthropic-key')->assertNoContent();

    $lock->release();

    Log::shouldHaveReceived('warning')
        ->once()
        ->with('Skipped a busy generation during an integration teardown', ['generation_id' => $busy->id]);

    // The busy generation was left exactly as it was -- never torn down.
    expect($busy->fresh()->status)->toBe(GenerationStatus::Running)
        ->and($busy->fresh()->file_ids)->toBe(['file_1'])
        // The rest of the organisation was still torn down despite the skip.
        ->and(array_keys($this->fake->calls))->toBe(['archiveAgent', 'archiveEnvironment'])
        ->and($this->fake->calls['archiveAgent'][0])->toBe([$key, 'agent_1'])
        ->and($this->fake->calls['archiveEnvironment'][0])->toBe([$key, 'env_1']);

    expect(Integration::forUser($teacher)->hasKey())->toBeFalse();
});

test('removing a key that was never set is a 204 and calls nothing', function () {
    $teacher = aTeacher();

    $this->actingAs($teacher)->deleteJson('/api/integrations/anthropic-key')->assertNoContent();

    expect($this->fake->calls)->toBe([]);
});

test('the key is bounded at 20 and 400 characters', function () {
    $teacher = aTeacher();
    $this->actingAs($teacher);

    $this->putJson('/api/integrations/anthropic-key', ['api_key' => str_repeat('a', 19)])
        ->assertStatus(422)->assertJsonValidationErrors(['api_key']);
    $this->putJson('/api/integrations/anthropic-key', ['api_key' => str_repeat('a', 401)])
        ->assertStatus(422)->assertJsonValidationErrors(['api_key']);
    $this->putJson('/api/integrations/anthropic-key', [])
        ->assertStatus(422)->assertJsonValidationErrors(['api_key']);

    expect($this->fake->calls)->toBe([]);
});

test('a typo must not cost the teacher their running generations', function () {
    $teacher = aTeacher();
    $integration = withAnthropicKey($teacher);
    $integration->forceFill([
        'anthropic_agent_id' => 'agent_1',
        'anthropic_environment_id' => 'env_1',
        'anthropic_agent_version' => 1,
    ])->save();
    $oldKey = $integration->apiKey();

    $generation = Generation::factory()->for($teacher)->create();

    $this->fake->rejectKeys();

    $this->actingAs($teacher)
        ->putJson('/api/integrations/anthropic-key', ['api_key' => str_repeat('n', 30)])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['api_key']);

    $row = Integration::forUser($teacher);
    expect($row->apiKey())->toBe($oldKey)
        ->and($row->anthropic_agent_id)->toBe('agent_1')
        ->and($row->anthropic_environment_id)->toBe('env_1')
        ->and($generation->fresh()->status)->toBe(GenerationStatus::Running)
        ->and(array_keys($this->fake->calls))->toBe(['verifyKey']);
});

test('only a teacher may set or remove a key', function () {
    foreach (Role::cases() as $role) {
        if ($role === Role::Teacher) {
            continue;
        }

        $this->actingAs(User::factory()->create(['role' => $role->value]));

        $this->putJson('/api/integrations/anthropic-key', ['api_key' => 'sk-ant-api03-abcdefghijklmnop1234'])->assertStatus(403);
        // The role gate must win over validation, malformed body and all.
        $this->putJson('/api/integrations/anthropic-key', ['api_key' => ''])->assertStatus(403);
        $this->deleteJson('/api/integrations/anthropic-key')->assertStatus(403);
    }

    expect($this->fake->calls)->toBe([]);
});
