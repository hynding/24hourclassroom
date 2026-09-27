<?php

use App\Enums\GenerationStatus;
use App\Enums\Role;
use App\Models\Generation;
use App\Models\User;
use Illuminate\Testing\TestResponse;

function generationsAdmin(): User
{
    return User::factory()->create(['role' => 'admin']);
}

/** @return list<int> */
function listedIds(TestResponse $response): array
{
    return collect($response->assertOk()->viewData('page')['props']['generations']['data'])->pluck('id')->all();
}

/**
 * Every admin generations route, for the allowlist loop. Tasks 5 and 6 add
 * the detail and action rows.
 *
 * @return list<array{0: string, 1: string}>
 */
function generationAdminRoutes(Generation $generation): array
{
    return [
        ['get', '/admin/generations'],
    ];
}

beforeEach(function () {
    $this->fake = fakeAnthropic();
});

test('non-admin roles cannot reach any generations admin route, and a guest is sent to login', function () {
    $generation = Generation::factory()->create();

    foreach (Role::cases() as $role) {
        if ($role === Role::Admin) {
            continue;
        }
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        foreach (generationAdminRoutes($generation) as [$method, $url]) {
            $this->{$method}($url)->assertStatus(403);
        }
    }

    $this->app['auth']->forgetGuards();
    foreach (generationAdminRoutes($generation) as [$method, $url]) {
        $this->{$method}($url)->assertRedirect('/login');
    }

    expect($generation->fresh()->status)->toBe(GenerationStatus::Running)
        ->and($this->fake->calls)->toBe([]);
});

test('the list is newest first and each filter narrows it, alone and combined', function () {
    $owner = aTeacher();
    $other = aTeacher();
    $oldFailed = Generation::factory()->for($owner)->failed()->create(['created_at' => now()->subDays(2), 'file_ids' => ['file_1']]);
    $running = Generation::factory()->for($owner)->create(['created_at' => now()->subDay()]);
    $othersDone = Generation::factory()->for($other)->done()->create(['created_at' => now()]);
    $this->actingAs(generationsAdmin());

    expect(listedIds($this->get('/admin/generations')))->toBe([$othersDone->id, $running->id, $oldFailed->id])
        ->and(listedIds($this->get('/admin/generations?status=failed')))->toBe([$oldFailed->id])
        ->and(listedIds($this->get('/admin/generations?status=live')))->toBe([$running->id])
        ->and(listedIds($this->get("/admin/generations?user={$owner->id}")))->toBe([$running->id, $oldFailed->id])
        ->and(listedIds($this->get('/admin/generations?leftovers=1')))->toBe([$oldFailed->id])
        ->and(listedIds($this->get('/admin/generations?leftovers=0')))->toBe([$othersDone->id, $running->id, $oldFailed->id])
        ->and(listedIds($this->get("/admin/generations?status=failed&user={$owner->id}&leftovers=1")))->toBe([$oldFailed->id])
        ->and(listedIds($this->get("/admin/generations?status=live&user={$owner->id}&leftovers=1")))->toBe([]);

    // Filters are echoed back for the form, and the statuses come from the server.
    $props = $this->get("/admin/generations?status=failed&user={$owner->id}&leftovers=1")->viewData('page')['props'];
    expect($props['filters'])->toBe(['status' => 'failed', 'user' => $owner->id, 'leftovers' => true])
        ->and($props['statuses'])->toBe(array_column(GenerationStatus::cases(), 'value'))
        ->and($props['notice'])->toBeNull();
});

test('an untouched filter form (empty strings) shows every row', function () {
    $generation = Generation::factory()->create();
    $this->actingAs(generationsAdmin());

    expect(listedIds($this->get('/admin/generations?status=&user=&leftovers=0')))->toBe([$generation->id]);
});

test('a running row is never a leftover, however its session and files look', function () {
    $live = Generation::factory()->create(['session_id' => 'sesn_1', 'archived_at' => null, 'file_ids' => ['file_1']]);
    $this->actingAs(generationsAdmin());

    $rows = $this->get('/admin/generations')->viewData('page')['props']['generations']['data'];

    expect($rows[0]['id'])->toBe($live->id)
        ->and($rows[0]['live'])->toBeTrue()
        ->and($rows[0]['has_leftovers'])->toBeFalse()
        ->and(listedIds($this->get('/admin/generations?leftovers=1')))->toBe([]);
});

test('a row carries the list shape and nothing about the owner but id and name', function () {
    $owner = aTeacher(['name' => 'Ms K']);
    withAnthropicKey($owner);
    $generation = Generation::factory()->for($owner)->done()->create([
        'title' => 'Volcanoes', 'subject' => 'science', 'grade_level' => '6-8',
        // Fixed instants, not two now() calls: the columns are second-precision
        // and a second boundary between the calls would make this 89 or 91.
        'list_cost_cents' => 150, 'started_at' => '2026-09-01 10:00:00', 'finished_at' => '2026-09-01 10:01:30',
    ]);
    $this->actingAs(generationsAdmin());

    $row = $this->get('/admin/generations')->viewData('page')['props']['generations']['data'][0];

    expect(array_keys($row))->toBe([
        'id', 'user', 'title', 'subject', 'grade_level', 'status', 'live', 'list_cost_cents',
        'started_at', 'finished_at', 'duration_seconds', 'has_leftovers', 'test_id',
    ])
        ->and($row['user'])->toBe(['id' => $owner->id, 'name' => 'Ms K'])
        ->and($row['status'])->toBe('done')
        ->and($row['live'])->toBeFalse()
        ->and($row['list_cost_cents'])->toBe(150)
        ->and($row['duration_seconds'])->toBe(90)
        ->and($row['has_leftovers'])->toBeFalse()
        ->and($row['test_id'])->toBeNull();
});

test('garbage filters are rejected and an unknown teacher id is just an empty page', function () {
    Generation::factory()->create();
    $this->actingAs(generationsAdmin());

    $this->getJson('/admin/generations?status=bogus')->assertStatus(422)->assertJsonValidationErrors('status');
    $this->getJson('/admin/generations?user=abc')->assertStatus(422)->assertJsonValidationErrors('user');
    $this->getJson('/admin/generations?leftovers=maybe')->assertStatus(422)->assertJsonValidationErrors('leftovers');

    expect(listedIds($this->get('/admin/generations?user=999999')))->toBe([]);
});

test('pagination keeps the filters', function () {
    $owner = aTeacher();
    Generation::factory()->for($owner)->failed()->count(21)->create();
    Generation::factory()->for($owner)->count(3)->create();
    $this->actingAs(generationsAdmin());

    $page = $this->get('/admin/generations?status=failed')->viewData('page')['props']['generations'];

    expect($page['data'])->toHaveCount(20)
        ->and($page['last_page'])->toBe(2)
        ->and($page['next_page_url'])->toContain('status=failed')
        ->and(collect($this->get($page['next_page_url'])->viewData('page')['props']['generations']['data'])->pluck('status')->unique()->all())->toBe(['failed']);
});
