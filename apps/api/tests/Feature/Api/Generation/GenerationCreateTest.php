<?php

use App\Ai\AnthropicProvisioner;
use App\Ai\Exceptions\AnthropicRejected;
use App\Ai\Exceptions\AnthropicUnavailable;
use App\Enums\GenerationStatus;
use App\Enums\Role;
use App\Models\Generation;
use App\Models\Integration;
use App\Models\User;
use App\Support\GenerationMessages;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
    Storage::fake(config('materials.disk'));
    $this->fake = fakeAnthropic();
});

function generationBody(array $overrides = []): array
{
    return array_merge([
        'title' => 'Cells quiz',
        'subject' => 'science',
        'grade_level' => '6-8',
        'instructions' => 'Focus on organelles.',
        'question_count' => 10,
        'material_ids' => [],
    ], $overrides);
}

test('a teacher without a key gets a 422 on api_key and no row', function () {
    $teacher = aTeacher();
    $material = aMaterial($teacher);
    $this->actingAs($teacher);

    $this->postJson('/api/generations', generationBody(['material_ids' => [$material->id]]))
        ->assertStatus(422)
        ->assertJsonValidationErrors(['api_key'])
        ->assertJsonPath('errors.api_key.0', GenerationMessages::KEY_REQUIRED);

    expect(Generation::count())->toBe(0)
        ->and($this->fake->calls)->toBe([]);
});

test('every bound is enforced, and nothing is created when one fails', function () {
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $material = aMaterial($teacher);
    $this->actingAs($teacher);
    $ids = [$material->id];

    $this->postJson('/api/generations', generationBody(['material_ids' => $ids, 'question_count' => config('generation.min_questions') - 1]))
        ->assertStatus(422)->assertJsonValidationErrors(['question_count']);
    $this->postJson('/api/generations', generationBody(['material_ids' => $ids, 'question_count' => config('generation.max_questions') + 1]))
        ->assertStatus(422)->assertJsonValidationErrors(['question_count']);
    $this->postJson('/api/generations', generationBody(['material_ids' => range(1, config('generation.max_materials') + 1)]))
        ->assertStatus(422)->assertJsonValidationErrors(['material_ids']);
    $this->postJson('/api/generations', generationBody(['material_ids' => [$material->id, $material->id]]))
        ->assertStatus(422)->assertJsonValidationErrors(['material_ids.0']);
    $this->postJson('/api/generations', generationBody(['material_ids' => $ids, 'title' => str_repeat('a', 161)]))
        ->assertStatus(422)->assertJsonValidationErrors(['title']);
    $this->postJson('/api/generations', generationBody(['material_ids' => $ids, 'instructions' => str_repeat('a', 4001)]))
        ->assertStatus(422)->assertJsonValidationErrors(['instructions']);
    $this->postJson('/api/generations', generationBody(['material_ids' => []]))
        ->assertStatus(422)->assertJsonValidationErrors(['material_ids']);
    $this->postJson('/api/generations', generationBody(['material_ids' => $ids, 'subject' => 'astrology']))
        ->assertStatus(422)->assertJsonValidationErrors(['subject']);

    expect(Generation::count())->toBe(0)
        ->and($this->fake->calls)->toBe([]);
});

test('a shared material, a strangers material and a missing id are one byte-identical 404', function () {
    // Shared material stays readable through the MCP server but is never
    // exported into a third-party organisation (spec decision 5 / ruling 9),
    // and the refusal must not tell the caller which case it hit.
    config(['app.debug' => false]);

    $teacher = aTeacher();
    withAnthropicKey($teacher);

    $other = aTeacher();
    $shared = aMaterial($other);
    shareWith($shared, $teacher);
    connectAccepted($other, $teacher);
    $strangers = aMaterial($other);

    $this->actingAs($teacher);

    $missing = $this->postJson('/api/generations', generationBody(['material_ids' => [99999]]))->assertStatus(404);
    $sharedResponse = $this->postJson('/api/generations', generationBody(['material_ids' => [$shared->id]]))->assertStatus(404);
    $strangersResponse = $this->postJson('/api/generations', generationBody(['material_ids' => [$strangers->id]]))->assertStatus(404);

    expect($sharedResponse->getContent())->toBe($missing->getContent())
        ->and($strangersResponse->getContent())->toBe($missing->getContent())
        ->and(Generation::count())->toBe(0)
        ->and($this->fake->calls)->toBe([]);
});

test('a body mixing an owned id with a strangers id is the same byte-identical 404', function () {
    // The all-or-nothing check in store() must not leak which id in a MIXED
    // list was the problem -- an owned id sitting beside a bad one is still
    // exactly the missing-id response.
    config(['app.debug' => false]);

    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $own = aMaterial($teacher);

    $other = aTeacher();
    $strangers = aMaterial($other);

    $this->actingAs($teacher);

    $missing = $this->postJson('/api/generations', generationBody(['material_ids' => [99999]]))->assertStatus(404);
    $mixed = $this->postJson('/api/generations', generationBody(['material_ids' => [$own->id, $strangers->id]]))->assertStatus(404);

    expect($mixed->getContent())->toBe($missing->getContent())
        ->and(Generation::count())->toBe(0)
        ->and($this->fake->calls)->toBe([]);
});

test('the first create provisions once and the second re-uses the same agent and environment', function () {
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $material = aMaterial($teacher);
    $this->actingAs($teacher);

    $this->postJson('/api/generations', generationBody(['material_ids' => [$material->id]]))->assertCreated();
    $this->postJson('/api/generations', generationBody(['material_ids' => [$material->id]]))->assertCreated();

    expect($this->fake->calls['createEnvironment'])->toHaveCount(1)
        ->and($this->fake->calls['createAgent'])->toHaveCount(1)
        ->and($this->fake->calls)->not->toHaveKey('updateAgent')
        ->and($this->fake->calls['createSession'])->toHaveCount(2)
        ->and(Generation::count())->toBe(2);
});

test('a config-hash drift updates the agent on the next create', function () {
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $material = aMaterial($teacher);
    $this->actingAs($teacher);

    $this->postJson('/api/generations', generationBody(['material_ids' => [$material->id]]))->assertCreated();

    config(['generation.effort' => 'medium']);

    $this->postJson('/api/generations', generationBody(['material_ids' => [$material->id]]))->assertCreated();

    expect($this->fake->calls['createAgent'])->toHaveCount(1)
        ->and($this->fake->calls['updateAgent'])->toHaveCount(1)
        ->and(Integration::forUser($teacher)->anthropic_config_hash)->toBe(app(AnthropicProvisioner::class)->configHash());
});

test('each material is uploaded once with its stored mime and original name, and the ids are recorded', function () {
    $teacher = aTeacher();
    $key = withAnthropicKey($teacher)->apiKey();
    $first = aMaterial($teacher, ['original_name' => 'cells.pdf', 'mime_type' => 'application/pdf']);
    $second = aMaterial($teacher, ['original_name' => 'mitosis.txt', 'mime_type' => 'text/plain']);
    $this->actingAs($teacher);

    $this->postJson('/api/generations', generationBody(['material_ids' => [$first->id, $second->id]]))->assertCreated();

    $uploads = $this->fake->calls['uploadFile'];
    $disk = Storage::disk(config('materials.disk'));

    expect($uploads)->toHaveCount(2)
        ->and($uploads[0])->toBe([$key, $disk->path($first->path), 'cells.pdf', 'application/pdf'])
        ->and($uploads[1])->toBe([$key, $disk->path($second->path), 'mitosis.txt', 'text/plain'])
        ->and(Generation::first()->file_ids)->toBe(['file_1', 'file_2']);
});

test('the session is created with the mounts in order, the budget, the title and a brief carrying the instructions', function () {
    $teacher = aTeacher();
    $key = withAnthropicKey($teacher)->apiKey();
    $first = aMaterial($teacher, ['original_name' => 'cells.pdf']);
    $second = aMaterial($teacher, ['original_name' => 'mitosis.pdf']);
    $this->actingAs($teacher);

    $response = $this->postJson('/api/generations', generationBody([
        'material_ids' => [$first->id, $second->id],
        'instructions' => 'Focus on organelles.',
    ]))->assertCreated();

    [$usedKey, $agentId, $agentVersion, $environmentId, $title, $resources, $budget, $brief] = $this->fake->calls['createSession'][0];

    expect($usedKey)->toBe($key)
        ->and($agentId)->toBe('agent_1')
        ->and($agentVersion)->toBe(1)
        ->and($environmentId)->toBe('env_1')
        ->and($title)->toBe('Cells quiz')
        ->and($resources)->toBe([
            ['type' => 'file', 'file_id' => 'file_1', 'mount_path' => '/workspace/materials/1-cells.pdf'],
            ['type' => 'file', 'file_id' => 'file_2', 'mount_path' => '/workspace/materials/2-mitosis.pdf'],
        ])
        ->and($budget)->toBe(config('generation.budget_cents'))
        ->and($brief)->toContain('Focus on organelles.')
        ->and($brief)->toContain('/workspace/materials/1-cells.pdf');

    $response->assertJsonPath('status', GenerationStatus::Running->value)
        ->assertJsonPath('title', 'Cells quiz')
        ->assertJsonPath('question_count', 10)
        ->assertJsonPath('material_ids', [$first->id, $second->id]);

    expect($response->json('started_at'))->not->toBeNull();

    $row = Generation::first();
    expect($row->session_id)->toBe('sesn_1')
        ->and($row->status)->toBe(GenerationStatus::Running)
        ->and($row->started_at)->not->toBeNull()
        ->and($row->user_id)->toBe($teacher->id);
});

test('with no instructions the brief carries no instructions heading', function () {
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $material = aMaterial($teacher);
    $this->actingAs($teacher);

    $this->postJson('/api/generations', generationBody([
        'material_ids' => [$material->id],
        'instructions' => null,
    ]))->assertCreated();

    // Index 7 is createSession()'s $initialText argument -- the brief.
    $brief = $this->fake->calls['createSession'][0][7];

    // brief.blade.php only prints the "The teacher's instructions" section
    // under @if (filled($instructions)) -- assert the heading itself is
    // absent, not merely that the (never-supplied) text is missing.
    expect($brief)->not->toContain("The teacher's instructions");
});

test('a gateway failure after the uploads fails the row, still 201, and deletes every uploaded file', function () {
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $first = aMaterial($teacher);
    $second = aMaterial($teacher);
    $this->fake->failNext('createSession', new AnthropicUnavailable('down', 503));
    $this->actingAs($teacher);

    $response = $this->postJson('/api/generations', generationBody(['material_ids' => [$first->id, $second->id]]))
        ->assertCreated()
        ->assertJsonPath('status', GenerationStatus::Failed->value);

    expect($response->json('error'))->toStartWith(GenerationMessages::CREATE_FAILED)
        ->and($response->json('error'))->toContain('down')
        ->and(array_map(fn (array $call) => $call[1], $this->fake->calls['deleteFile']))->toBe(['file_1', 'file_2'])
        ->and(Generation::first()->file_ids)->toBeNull()
        ->and(Generation::first()->finished_at)->not->toBeNull();
});

test('a 404 from createSession clears the provisioning and re-provisions exactly once', function () {
    // The stored agent or environment is gone, or the key now belongs to
    // another organisation: one silent recovery, never a loop.
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $material = aMaterial($teacher);
    $this->fake->failNext('createSession', new AnthropicRejected('gone', 404));
    $this->actingAs($teacher);

    $this->postJson('/api/generations', generationBody(['material_ids' => [$material->id]]))
        ->assertCreated()
        ->assertJsonPath('status', GenerationStatus::Running->value);

    expect($this->fake->calls['createAgent'])->toHaveCount(2)
        ->and($this->fake->calls['createEnvironment'])->toHaveCount(2)
        ->and($this->fake->calls['createSession'])->toHaveCount(2);

    $row = Integration::forUser($teacher);
    expect($row->anthropic_agent_id)->toBe('agent_2')
        ->and($row->anthropic_environment_id)->toBe('env_2');
});

test('a 404 from createSession archives the OLD agent and environment before re-provisioning', function () {
    // Without this, clearProvisioning() just forgets the ids locally and the
    // old agent/environment stay alive and unreachable in the teacher's
    // organisation -- a leak on every re-provision, not only the ones where
    // the pair really is gone.
    $teacher = aTeacher();
    $key = withAnthropicKey($teacher)->apiKey();
    $material = aMaterial($teacher);
    $this->fake->failNext('createSession', new AnthropicRejected('gone', 404));
    $this->actingAs($teacher);

    $this->postJson('/api/generations', generationBody(['material_ids' => [$material->id]]))
        ->assertCreated()
        ->assertJsonPath('status', GenerationStatus::Running->value);

    expect($this->fake->calls['archiveAgent'])->toHaveCount(1)
        ->and($this->fake->calls['archiveAgent'][0])->toBe([$key, 'agent_1'])
        ->and($this->fake->calls['archiveEnvironment'])->toHaveCount(1)
        ->and($this->fake->calls['archiveEnvironment'][0])->toBe([$key, 'env_1'])
        ->and($this->fake->calls['createAgent'])->toHaveCount(2)
        ->and($this->fake->calls['createEnvironment'])->toHaveCount(2);
});

test('a second failure after the re-provision fails the row', function () {
    $teacher = aTeacher();
    withAnthropicKey($teacher);
    $material = aMaterial($teacher);
    $this->actingAs($teacher);

    // Both attempts rejected: the first arms the retry, the second is fatal.
    $this->fake->failNext('createSession', new AnthropicRejected('gone', 404));
    $this->postJson('/api/generations', generationBody(['material_ids' => [$material->id]]))->assertCreated();

    $this->fake->failNext('createSession', new AnthropicRejected('gone again', 404));
    $this->fake->failNext('createSession', new AnthropicRejected('still gone', 404));

    $this->postJson('/api/generations', generationBody(['material_ids' => [$material->id]]))
        ->assertCreated()
        ->assertJsonPath('status', GenerationStatus::Failed->value);

    expect(Generation::latest('id')->first()->error)->toStartWith(GenerationMessages::CREATE_FAILED);
});

test('only a teacher may create a generation, malformed body and all', function () {
    foreach (Role::cases() as $role) {
        if ($role === Role::Teacher) {
            continue;
        }

        $this->actingAs(User::factory()->create(['role' => $role->value]));

        $this->postJson('/api/generations', generationBody(['material_ids' => [1]]))->assertStatus(403);
        $this->postJson('/api/generations', ['title' => ''])->assertStatus(403);
    }

    expect(Generation::count())->toBe(0)
        ->and($this->fake->calls)->toBe([]);
});
