<?php

use App\Enums\Role;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
    Storage::fake(config('materials.disk'));
});

test('a private material is 404 for everyone but the author and a live recipient, byte-identical to a missing id', function () {
    $author = aTeacher();
    $material = aMaterial($author);

    $missing = $this->getJson('/api/materials/999999')->assertStatus(404)->getContent();
    expect($missing)->toBe('{"message":"Not found."}');

    expect($this->getJson("/api/materials/{$material->id}")->assertStatus(404)->getContent())->toBe($missing);

    foreach (Role::cases() as $role) {
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        expect($this->getJson("/api/materials/{$material->id}")->assertStatus(404)->getContent())
            ->toBe($missing, "role {$role->value} got a distinguishable body");
    }

    $this->actingAs($author);
    $this->getJson("/api/materials/{$material->id}")->assertOk()
        ->assertJsonPath('is_author', true)
        ->assertJsonPath('shared_with_me', false);

    $recipient = aStudent();
    shareWith($material, $recipient);
    connectAccepted($author, $recipient);
    $this->actingAs($recipient);
    $this->getJson("/api/materials/{$material->id}")->assertOk()
        ->assertJsonPath('is_author', false)
        ->assertJsonPath('shared_with_me', true);
});

test('the view payload carries exactly the MaterialView keys', function () {
    $author = aTeacher();
    $material = aMaterial($author, ['title' => 'Fractions handout', 'description' => 'Ten minutes.', 'subject' => 'math', 'grade_level' => '3-5', 'original_name' => 'fractions.pdf', 'mime_type' => 'application/pdf', 'size_bytes' => 4096]);
    $this->actingAs($author);

    $body = $this->getJson("/api/materials/{$material->id}")->assertOk()->json();

    expect(array_keys($body))->toBe([
        'id', 'title', 'subject', 'grade_level', 'visibility', 'published_at',
        'original_name', 'mime_type', 'size_bytes', 'author',
        'description', 'created_at', 'updated_at',
        'is_author', 'shared_with_me', 'download_url',
    ]);

    expect($body['title'])->toBe('Fractions handout')
        ->and($body['subject'])->toBe('math')
        ->and($body['grade_level'])->toBe('3-5')
        ->and($body['visibility'])->toBe('private')
        ->and($body['original_name'])->toBe('fractions.pdf')
        ->and($body['mime_type'])->toBe('application/pdf')
        ->and($body['size_bytes'])->toBe(4096)
        ->and($body['author'])->toBe(['id' => $author->id, 'name' => $author->name])
        ->and($body['published_at'])->toBeNull();
});

test('a public material is readable logged out and by every role', function () {
    $author = aTeacher();
    $material = aMaterial($author, ['visibility' => 'public', 'published_at' => now()]);

    $this->getJson("/api/materials/{$material->id}")->assertOk()
        ->assertJsonPath('is_author', false)
        ->assertJsonPath('shared_with_me', false)
        ->assertJsonPath('visibility', 'public');

    foreach (Role::cases() as $role) {
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        $this->getJson("/api/materials/{$material->id}")->assertOk()->assertJsonPath('is_author', false);
    }

    $this->actingAs($author);
    $this->getJson("/api/materials/{$material->id}")->assertOk()->assertJsonPath('is_author', true);
});

test('a deactivated author hides the public path but not the shared path', function () {
    $author = aTeacher();
    $material = aMaterial($author, ['visibility' => 'public', 'published_at' => now()]);
    $recipient = aStudent();
    shareWith($material, $recipient);
    connectAccepted($author, $recipient);
    $author->forceFill(['deactivated_at' => now()])->save();

    $this->getJson("/api/materials/{$material->id}")->assertStatus(404);
    $this->actingAs(aTeacher());
    $this->getJson("/api/materials/{$material->id}")->assertStatus(404);
    $this->actingAs($recipient);
    $this->getJson("/api/materials/{$material->id}")->assertOk()->assertJsonPath('shared_with_me', true);
});

test('a share with no accepted connection is invisible, and returns when the connection does', function () {
    $author = aTeacher();
    $material = aMaterial($author);
    $recipient = aTeacher();
    shareWith($material, $recipient);
    $this->actingAs($recipient);

    $this->getJson("/api/materials/{$material->id}")->assertStatus(404);

    $connection = connectAccepted($author, $recipient);
    $this->getJson("/api/materials/{$material->id}")->assertOk();

    $connection->delete();
    $this->getJson("/api/materials/{$material->id}")->assertStatus(404);
});

test('/materials/shared is never swallowed by the {material} route', function () {
    // Route::pattern('material', '[0-9]+') is what guarantees this; without it
    // the public show route would match the literal path and 404 it.
    $this->getJson('/api/materials/shared')->assertStatus(401);
});
