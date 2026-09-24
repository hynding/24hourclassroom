<?php

use App\Enums\GenerationStatus;
use App\Enums\Role;
use App\Models\Generation;
use App\Models\User;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
    $this->fake = fakeAnthropic();
});

test('the list carries only the callers own rows, newest first', function () {
    $teacher = aTeacher();
    $oldest = Generation::factory()->create(['user_id' => $teacher->id, 'title' => 'Oldest']);
    $newest = Generation::factory()->create(['user_id' => $teacher->id, 'title' => 'Newest']);
    Generation::factory()->create(['user_id' => aTeacher()->id, 'title' => 'Someone elses']);

    $this->actingAs($teacher)->getJson('/api/generations')->assertOk()
        ->assertJsonCount(2, 'data')
        ->assertJsonPath('data.0.id', $newest->id)
        ->assertJsonPath('data.1.id', $oldest->id)
        ->assertJsonMissing(['title' => 'Someone elses'])
        ->assertJsonPath('meta.total', 2);
});

test('the list paginates at fifteen a page', function () {
    $teacher = aTeacher();
    Generation::factory()->count(16)->create(['user_id' => $teacher->id]);

    $this->actingAs($teacher)->getJson('/api/generations')->assertOk()
        ->assertJsonCount(15, 'data')
        ->assertJsonPath('meta.current_page', 1)
        ->assertJsonPath('meta.last_page', 2)
        ->assertJsonPath('meta.per_page', 15)
        ->assertJsonPath('meta.total', 16);

    $this->getJson('/api/generations?page=2')->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('meta.current_page', 2);
});

test('each row carries exactly the generation payload', function () {
    $teacher = aTeacher();
    $generation = Generation::factory()->done()->create([
        'user_id' => $teacher->id,
        'instructions' => 'Two decimals.',
        'material_ids' => [3, 9],
        'agent_note' => 'Drafted from the mitosis handout.',
        'list_cost_cents' => 137,
    ]);

    $response = $this->actingAs($teacher)->getJson('/api/generations')->assertOk()
        ->assertJsonPath('data.0.status', GenerationStatus::Done->value)
        ->assertJsonPath('data.0.instructions', 'Two decimals.')
        ->assertJsonPath('data.0.material_ids', [3, 9])
        ->assertJsonPath('data.0.agent_note', 'Drafted from the mitosis handout.')
        ->assertJsonPath('data.0.list_cost_cents', 137)
        ->assertJsonPath('data.0.test_id', null);

    expect(array_keys($response->json('data.0')))->toBe([
        'id', 'title', 'subject', 'grade_level', 'instructions', 'question_count',
        'material_ids', 'status', 'agent_note', 'error', 'list_cost_cents',
        'test_id', 'started_at', 'finished_at', 'created_at',
    ])->and($generation->fresh()->user_id)->toBe($teacher->id);
});

test('only a teacher may list generations', function () {
    foreach (Role::cases() as $role) {
        if ($role === Role::Teacher) {
            continue;
        }

        $this->actingAs(User::factory()->create(['role' => $role->value]));
        $this->getJson('/api/generations')->assertStatus(403);
    }
});

// plan 3 appends the GET /generations/{id} cases here

// ---------------------------------------------------------------------------
// The poll endpoint, GET /api/generations/{generation} (plan 3).
// `fakeAnthropic()` is called inside each case as well as in this file's
// beforeEach: re-calling it rebinds a fresh fake, and the local handle is what
// the assertions read. No case here may reach the real gateway.
// ---------------------------------------------------------------------------

test('the owner polls a terminal generation and gets its payload', function () {
    $fake = fakeAnthropic();
    $owner = aTeacher();
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->done()->create([
        'title' => 'Cell biology quiz',
        'agent_note' => 'Read three chapters.',
        'list_cost_cents' => 41,
    ]);
    $this->actingAs($owner);

    $this->getJson("/api/generations/{$generation->id}")->assertOk()
        ->assertJsonPath('id', $generation->id)
        ->assertJsonPath('title', 'Cell biology quiz')
        ->assertJsonPath('status', 'done')
        ->assertJsonPath('agent_note', 'Read three chapters.')
        ->assertJsonPath('list_cost_cents', 41)
        ->assertJsonStructure([
            'id', 'title', 'subject', 'grade_level', 'instructions', 'question_count',
            'material_ids', 'status', 'agent_note', 'error', 'list_cost_cents', 'test_id',
            'started_at', 'finished_at', 'created_at',
        ]);

    // A terminal row is never advanced: the controller skips the advancer, so
    // nothing is asked of Anthropic on a poll that has nothing left to do.
    expect($fake->calls)->toBe([]);
});

test('a teacher who is not the owner gets an identical 404 for an existing and a missing generation', function () {
    // Debug bodies embed the calling line; the oracle check needs the
    // production shape (repo convention).
    config(['app.debug' => false]);
    fakeAnthropic();
    $generation = Generation::factory()->for(aTeacher())->create();
    $this->actingAs(aTeacher());

    $existing = $this->getJson("/api/generations/{$generation->id}")->assertStatus(404);
    $missing = $this->getJson('/api/generations/999999')->assertStatus(404);

    // Byte-identical: a generation you do not own must not be distinguishable
    // from one that never existed (spec decision 11).
    expect($existing->getContent())->toBe($missing->getContent())
        ->and($existing->json('message'))->toBe('Not found.');
});

test('every non-teacher role is 403 on an existing and a missing generation alike', function () {
    config(['app.debug' => false]);
    fakeAnthropic();
    $generation = Generation::factory()->for(aTeacher())->create();

    foreach (Role::cases() as $role) {
        if ($role === Role::Teacher) {
            continue;
        }
        $this->actingAs(User::factory()->create(['role' => $role->value]));

        // This pair is the proof that `teacher` is prepended to the priority
        // list AHEAD of SubstituteBindings in bootstrap/app.php. If the gate
        // ran after route-model binding, the missing id would 404 and the
        // existing one 403 -- and the pair would tell a student exactly which
        // generation ids exist, the existence oracle CLAUDE.md warns about.
        $existing = $this->getJson("/api/generations/{$generation->id}")->assertStatus(403);
        $missing = $this->getJson('/api/generations/999999')->assertStatus(403);
        expect($existing->getContent())->toBe($missing->getContent());
    }
});
