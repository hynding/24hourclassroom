<?php

use App\Enums\Role;
use App\Models\Material;
use App\Models\User;
use App\Notifications\MaterialModerated;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake(config('materials.disk'));
});

function materialsAdmin(): User
{
    return User::factory()->create(['role' => 'admin']);
}

test('non-admin roles cannot reach the materials moderation page', function () {
    $author = aTeacher();
    $material = aMaterial($author, ['visibility' => 'public', 'published_at' => now()]);

    foreach (Role::cases() as $role) {
        if ($role === Role::Admin) {
            continue;
        }
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        $this->get('/admin/materials')->assertStatus(403);
        $this->post("/admin/materials/{$material->id}/unpublish")->assertStatus(403);
        $this->delete("/admin/materials/{$material->id}")->assertStatus(403);

        expect($material->fresh()->visibility->value)->toBe('public')
            ->and(Material::find($material->id))->not->toBeNull();
    }

    $this->app['auth']->forgetGuards();
    $this->get('/admin/materials')->assertRedirect('/login');
});

test('the admin lists public materials only, and can search them', function () {
    $author = aTeacher();
    $public = aMaterial($author, ['visibility' => 'public', 'published_at' => now(), 'title' => 'Volcano handout', 'size_bytes' => 4096]);
    aMaterial($author, ['title' => 'Private draft']);
    $this->actingAs(materialsAdmin());

    $rows = $this->get('/admin/materials')->assertOk()->viewData('page')['props']['materials']['data'];
    expect(collect($rows)->pluck('id')->all())->toBe([$public->id]);
    expect(array_keys($rows[0]))->toBe(['id', 'title', 'author', 'subject', 'grade_level', 'size_bytes', 'published_at']);
    expect($rows[0]['author']['name'])->toBe($author->name)
        ->and($rows[0]['size_bytes'])->toBe(4096);

    expect(collect($this->get('/admin/materials?q=volc')->viewData('page')['props']['materials']['data'])->pluck('id')->all())
        ->toBe([$public->id]);
    expect($this->get('/admin/materials?q=zzz')->viewData('page')['props']['materials']['data'])->toBe([]);
});

test('unpublishing notifies the author, and a private id is a silent no-op', function () {
    $author = aTeacher();
    $public = aMaterial($author, ['visibility' => 'public', 'published_at' => now(), 'title' => 'Volcano handout']);
    $private = aMaterial($author, ['title' => 'Private draft']);
    $this->actingAs(materialsAdmin());

    $this->post("/admin/materials/{$public->id}/unpublish")->assertRedirect();

    expect($public->fresh()->visibility->value)->toBe('private')
        ->and($author->notifications()->count())->toBe(1)
        ->and($author->notifications()->first()->type)->toBe(MaterialModerated::class)
        ->and($author->notifications()->first()->data['material_id'])->toBe($public->id)
        ->and($author->notifications()->first()->data['material_title'])->toBe('Volcano handout')
        ->and($author->notifications()->first()->data['message'])
        ->toBe('An administrator removed "Volcano handout" from the public library.')
        // Actor-less, like TestModerated: no `user` key, so
        // NotificationController::visible() never hides it.
        ->and($author->notifications()->first()->data)->not->toHaveKey('user');

    $this->post("/admin/materials/{$private->id}/unpublish")->assertRedirect();
    expect($author->fresh()->notifications()->count())->toBe(1);
});

test('the admin deletes by id, private ones included, and the file goes too', function () {
    $author = aTeacher();
    $private = aMaterial($author, ['title' => 'Reported but never published']);
    shareWith($private, aStudent());
    $path = $private->path;
    $this->actingAs(materialsAdmin());

    // Intended: an admin removing a reported file must not have to publish it
    // first, even though the list shows only public materials (mirrors
    // TestAdminController).
    $this->delete("/admin/materials/{$private->id}")->assertRedirect();

    expect(Material::find($private->id))->toBeNull()
        ->and(\App\Models\MaterialShare::count())->toBe(0);
    Storage::disk(config('materials.disk'))->assertMissing($path);
    // Deleting sends nothing: the row is gone, as with tests.
    expect($author->notifications()->count())->toBe(0);
});
