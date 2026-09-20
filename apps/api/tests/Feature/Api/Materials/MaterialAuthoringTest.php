<?php

use App\Enums\Role;
use App\Models\Material;
use App\Models\MaterialShare;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
    $this->withHeader('Accept', 'application/json');
    Storage::fake(config('materials.disk'));
});

test('the author updates metadata and gets a MaterialView with a fresh download_url', function () {
    $author = aTeacher();
    $material = aMaterial($author, ['title' => 'Old', 'subject' => 'math', 'grade_level' => '3-5']);
    $this->actingAs($author);

    $response = $this->putJson("/api/materials/{$material->id}", [
        'title' => 'New title',
        'description' => 'Rewritten.',
        'subject' => 'science',
        'grade_level' => '6-8',
    ])->assertOk()
        ->assertJsonPath('title', 'New title')
        ->assertJsonPath('description', 'Rewritten.')
        ->assertJsonPath('subject', 'science')
        ->assertJsonPath('grade_level', '6-8')
        ->assertJsonPath('is_author', true);

    expect($response->json('download_url'))->toContain("/api/materials/{$material->id}/file");
    $this->get(\Illuminate\Support\Str::after($response->json('download_url'), rtrim(config('app.url'), '/')))->assertOk();
});

test('update is metadata only: a posted file part is ignored and the stored bytes are untouched', function () {
    $author = aTeacher();
    $material = aMaterial($author);
    $before = Storage::disk(config('materials.disk'))->get($material->path);
    $this->actingAs($author);

    $this->post("/api/materials/{$material->id}", [
        '_method' => 'PUT',
        'file' => materialFixture('sample.txt'),
        'title' => 'Still the same file',
        'subject' => 'math',
        'grade_level' => '3-5',
    ])->assertOk()->assertJsonPath('title', 'Still the same file');

    $fresh = $material->fresh();
    expect($fresh->path)->toBe($material->path)
        ->and($fresh->mime_type)->toBe('application/pdf')
        ->and(Storage::disk(config('materials.disk'))->get($fresh->path))->toBe($before)
        ->and(Storage::disk(config('materials.disk'))->allFiles())->toHaveCount(1);
});

test('update rejects a missing title or a bad enum with 422', function () {
    $author = aTeacher();
    $material = aMaterial($author);
    $this->actingAs($author);

    $this->putJson("/api/materials/{$material->id}", ['subject' => 'math', 'grade_level' => '3-5'])
        ->assertStatus(422)->assertJsonValidationErrors('title');
    $this->putJson("/api/materials/{$material->id}", ['title' => 'x', 'subject' => 'nope', 'grade_level' => '3-5'])
        ->assertStatus(422)->assertJsonValidationErrors('subject');
});

test('delete removes the row, its shares and the file, through MaterialDeleter', function () {
    $author = aTeacher();
    $material = aMaterial($author);
    $recipient = aStudent();
    shareWith($material, $recipient);
    $path = $material->path;
    $this->actingAs($author);

    $this->deleteJson("/api/materials/{$material->id}")->assertNoContent();

    expect(Material::find($material->id))->toBeNull()
        ->and(MaterialShare::count())->toBe(0);
    Storage::disk(config('materials.disk'))->assertMissing($path);
});

test('a failed file delete is logged at warning level and the request still 204s', function () {
    $author = aTeacher();
    $material = aMaterial($author);
    $this->actingAs($author);

    // The local disk is throw => false, so Storage::delete() reports failure
    // by returning false. Nothing about that is the caller's problem: the row
    // is gone either way, and an orphan file is an operational concern.
    $fake = Storage::disk(config('materials.disk'));
    $mocked = Mockery::mock($fake)->makePartial();
    $mocked->shouldReceive('delete')->andReturn(false);
    Storage::set(config('materials.disk'), $mocked);

    Log::shouldReceive('warning')->once()->withArgs(fn (string $message, array $context) => str_contains($message, 'material')
        && $context['path'] === $material->path);

    $this->deleteJson("/api/materials/{$material->id}")->assertNoContent();
    expect(Material::find($material->id))->toBeNull();
});

test('a non-author cannot update or delete: 404 on private, 403 on public', function () {
    $author = aTeacher();
    $private = aMaterial($author);
    $public = aMaterial($author, ['visibility' => 'public', 'published_at' => now()]);
    $body = ['title' => 'Hijacked', 'subject' => 'math', 'grade_level' => '3-5'];

    foreach (Role::cases() as $role) {
        $this->actingAs(User::factory()->create(['role' => $role->value]));

        $this->putJson("/api/materials/{$private->id}", $body)->assertStatus(404);
        $this->deleteJson("/api/materials/{$private->id}")->assertStatus(404);
        $this->putJson("/api/materials/{$public->id}", $body)->assertStatus(403);
        $this->deleteJson("/api/materials/{$public->id}")->assertStatus(403);
    }

    expect(Material::count())->toBe(2)->and($private->fresh()->title)->not->toBe('Hijacked');
});

test('a recipient of a live share still cannot edit it', function () {
    $author = aTeacher();
    $material = aMaterial($author);
    $recipient = aTeacher();
    shareWith($material, $recipient);
    connectAccepted($author, $recipient);
    $this->actingAs($recipient);

    // Visible (200 on show) but 404 on the author routes: a recipient must
    // not learn a private material is editable.
    $this->getJson("/api/materials/{$material->id}")->assertOk();
    $this->putJson("/api/materials/{$material->id}", ['title' => 'Nope', 'subject' => 'math', 'grade_level' => '3-5'])
        ->assertStatus(404);
    $this->deleteJson("/api/materials/{$material->id}")->assertStatus(404);
});
