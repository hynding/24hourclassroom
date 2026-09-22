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
