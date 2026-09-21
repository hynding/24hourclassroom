<?php

use App\Enums\Role;
use App\Models\MaterialShare;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
    $this->withHeader('Accept', 'application/json');
    Storage::fake(config('materials.disk'));
});

test('publishing stamps published_at once, is idempotent, and re-stamps after an unpublish', function () {
    $author = aTeacher();
    $material = aMaterial($author);
    $this->actingAs($author);

    // No content precondition, unlike a test: a material always has its file.
    $this->postJson("/api/materials/{$material->id}/publish")->assertOk()
        ->assertJsonPath('visibility', 'public')
        ->assertJsonPath('is_author', true);

    $first = $material->fresh()->published_at;
    expect($first)->not->toBeNull();

    $this->postJson("/api/materials/{$material->id}/publish")->assertOk();
    expect($material->fresh()->published_at->equalTo($first))->toBeTrue();

    $this->postJson("/api/materials/{$material->id}/unpublish")->assertOk()
        ->assertJsonPath('visibility', 'private');
    $this->postJson("/api/materials/{$material->id}/unpublish")->assertOk();

    // A re-publish moves it back to the top of the library.
    $this->travel(5)->minutes();
    $this->postJson("/api/materials/{$material->id}/publish")->assertOk();
    expect($material->fresh()->published_at->greaterThan($first))->toBeTrue();
});

test('both responses are the full MaterialView with a working download_url', function () {
    $author = aTeacher();
    $material = aMaterial($author);
    $this->actingAs($author);

    foreach (['publish', 'unpublish'] as $action) {
        $body = $this->postJson("/api/materials/{$material->id}/{$action}")->assertOk()->json();

        expect(array_keys($body))->toBe([
            'id', 'title', 'subject', 'grade_level', 'visibility', 'published_at',
            'original_name', 'mime_type', 'size_bytes', 'author',
            'description', 'created_at', 'updated_at',
            'is_author', 'shared_with_me', 'download_url',
        ]);

        $this->get(\Illuminate\Support\Str::after($body['download_url'], rtrim(config('app.url'), '/')))->assertOk();
    }
});

test('unpublishing leaves shares alone', function () {
    $author = aTeacher();
    $material = aMaterial($author, ['visibility' => 'public', 'published_at' => now()]);
    $recipient = aStudent();
    shareWith($material, $recipient);
    connectAccepted($author, $recipient);
    $this->actingAs($author);

    $this->postJson("/api/materials/{$material->id}/unpublish")->assertOk();

    expect(MaterialShare::count())->toBe(1);
    $this->actingAs($recipient);
    $this->getJson("/api/materials/{$material->id}")->assertOk()->assertJsonPath('shared_with_me', true);
});

test('a non-author cannot publish or unpublish: 404 private, 403 public', function () {
    $author = aTeacher();
    $private = aMaterial($author);
    $public = aMaterial($author, ['visibility' => 'public', 'published_at' => now()]);

    foreach (Role::cases() as $role) {
        $this->actingAs(User::factory()->create(['role' => $role->value]));

        $this->postJson("/api/materials/{$private->id}/publish")->assertStatus(404);
        $this->postJson("/api/materials/{$private->id}/unpublish")->assertStatus(404);
        $this->postJson("/api/materials/{$public->id}/publish")->assertStatus(403);
        $this->postJson("/api/materials/{$public->id}/unpublish")->assertStatus(403);
    }

    expect($private->fresh()->isPublic())->toBeFalse()->and($public->fresh()->isPublic())->toBeTrue();
});
