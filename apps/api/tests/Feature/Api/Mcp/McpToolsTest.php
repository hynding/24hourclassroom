<?php

use App\Enums\Role;
use App\Mcp\Servers\TeacherServer;
use App\Mcp\Tools\ListMaterials;
use App\Models\Connection;
use App\Models\Material;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\Fluent\AssertableJson;

beforeEach(function () {
    Storage::fake(config('materials.disk'));
});

test('list_materials mine lists only the teachers own materials', function () {
    $teacher = aTeacher();
    $mine = Material::factory()->for($teacher, 'author')->create(['title' => 'My cells handout']);

    $other = aTeacher();
    $shared = Material::factory()->for($other, 'author')->create(['title' => 'Their photosynthesis notes']);
    shareWith($shared, $teacher);
    connectAccepted($other, $teacher);

    Material::factory()->for(aTeacher(), 'author')->create(['title' => 'A strangers material']);

    $this->actingAs($teacher);

    TeacherServer::tool(ListMaterials::class, ['scope' => 'mine'])
        ->assertOk()
        ->assertStructuredContent(fn (AssertableJson $json) => $json
            ->has('data', 1)
            ->where('data.0.id', $mine->id)
            ->where('data.0.title', 'My cells handout')
            ->where('meta.total', 1)
            ->etc());
});

test('list_materials shared lists only materials shared through a live connection', function () {
    $teacher = aTeacher();

    $connected = aTeacher();
    $live = Material::factory()->for($connected, 'author')->create(['title' => 'Shared and connected']);
    shareWith($live, $teacher);
    connectAccepted($connected, $teacher);

    // Shared, but the two were never connected.
    $stranger = aTeacher();
    $noConnection = Material::factory()->for($stranger, 'author')->create(['title' => 'Shared, no connection']);
    shareWith($noConnection, $teacher);

    // Shared, and the connection is only pending -- disconnecting hides a
    // material without deleting the share row (C2 decision 4).
    $pending = aTeacher();
    $disconnected = Material::factory()->for($pending, 'author')->create(['title' => 'Shared, disconnected']);
    shareWith($disconnected, $teacher);
    Connection::create([
        'requester_id' => $pending->id,
        'addressee_id' => $teacher->id,
        'status' => 'pending',
        'pair_key' => Connection::pairKey($pending->id, $teacher->id),
    ]);

    // And the teacher's own material is not "shared with" them.
    Material::factory()->for($teacher, 'author')->create(['title' => 'My own']);

    $this->actingAs($teacher);

    TeacherServer::tool(ListMaterials::class, ['scope' => 'shared'])
        ->assertOk()
        ->assertStructuredContent(fn (AssertableJson $json) => $json
            ->has('data', 1)
            ->where('data.0.id', $live->id)
            ->where('data.0.shared_by.id', $connected->id)
            ->where('data.0.shared_by.name', $connected->name)
            ->where('meta.total', 1)
            ->etc());
});

test('list_materials all combines own and shared and paginates at fifteen', function () {
    $teacher = aTeacher();
    Material::factory()->count(14)->for($teacher, 'author')->create();

    $connected = aTeacher();
    $shared = Material::factory()->for($connected, 'author')->create();
    shareWith($shared, $teacher);
    connectAccepted($connected, $teacher);

    $newest = Material::factory()->for($teacher, 'author')->create(['title' => 'Newest of mine']);

    $this->actingAs($teacher);

    // 16 rows: 15 own + 1 shared.
    TeacherServer::tool(ListMaterials::class)
        ->assertOk()
        ->assertStructuredContent(fn (AssertableJson $json) => $json
            ->has('data', 15)
            ->where('data.0.id', $newest->id)
            ->where('meta.current_page', 1)
            ->where('meta.last_page', 2)
            ->where('meta.per_page', 15)
            ->where('meta.total', 16)
            ->etc());

    TeacherServer::tool(ListMaterials::class, ['page' => 2])
        ->assertOk()
        ->assertStructuredContent(fn (AssertableJson $json) => $json
            ->has('data', 1)
            ->where('meta.current_page', 2)
            ->etc());
});

test('every non-teacher role is refused by the tools themselves', function () {
    // The route middleware already answers 403, but the Pest harness calls
    // the tool directly -- and so would any future transport. The allowlist
    // lives in the tool too.
    foreach (Role::cases() as $role) {
        if ($role === Role::Teacher) {
            continue;
        }

        $this->actingAs(User::factory()->create(['role' => $role->value]));

        TeacherServer::tool(ListMaterials::class, ['scope' => 'mine'])
            ->assertHasErrors(['Only teachers']);
    }
});

test('the server registers list_materials', function () {
    TeacherServer::tools()->assertRegistered(ListMaterials::class);
});
