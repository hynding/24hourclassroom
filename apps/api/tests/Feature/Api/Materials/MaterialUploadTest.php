<?php

use App\Enums\Role;
use App\Models\Material;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
    $this->withHeader('Accept', 'application/json');
    Storage::fake(config('materials.disk'));
});

function uploadBody(array $overrides = []): array
{
    return array_merge([
        'file' => materialFixture('sample.pdf'),
        'title' => 'Fractions handout',
        'description' => 'Ten minutes.',
        'subject' => 'math',
        'grade_level' => '3-5',
    ], $overrides);
}

test('a teacher uploads a material and gets the full MaterialView back', function () {
    $teacher = aTeacher();
    $this->actingAs($teacher);

    $response = $this->post('/api/materials', uploadBody())->assertCreated();

    $material = Material::sole();

    $response->assertJsonPath('id', $material->id)
        ->assertJsonPath('title', 'Fractions handout')
        ->assertJsonPath('description', 'Ten minutes.')
        ->assertJsonPath('subject', 'math')
        ->assertJsonPath('grade_level', '3-5')
        ->assertJsonPath('visibility', 'private')
        ->assertJsonPath('published_at', null)
        ->assertJsonPath('original_name', 'sample.pdf')
        ->assertJsonPath('mime_type', 'application/pdf')
        ->assertJsonPath('is_author', true)
        ->assertJsonPath('shared_with_me', false)
        ->assertJsonPath('author.id', $teacher->id);

    expect($response->json('download_url'))->toContain("/api/materials/{$material->id}/file")
        ->and($response->json('size_bytes'))->toBe(filesize(base_path('tests/Fixtures/materials/sample.pdf')));

    // Stored on the CONFIGURED disk, under the author's folder, with a
    // server-generated name -- never the client's.
    expect($material->path)->toStartWith("materials/{$teacher->id}/")
        ->and($material->path)->not->toContain('sample')
        ->and($material->path)->toEndWith('.pdf');
    Storage::disk(config('materials.disk'))->assertExists($material->path);
    Storage::disk('public')->assertMissing($material->path);
});

test('every allowlisted extension is accepted from its real fixture, with a server-detected mime type', function () {
    $teacher = aTeacher();
    $this->actingAs($teacher);

    foreach (config('materials.extensions') as $ext) {
        $this->post('/api/materials', uploadBody([
            'file' => materialFixture("sample.{$ext}"),
            'title' => "A {$ext} file",
        ]))->assertCreated();

        $material = Material::where('title', "A {$ext} file")->sole();

        expect($material->path)->toEndWith(".{$ext}")
            ->and($material->mime_type)->toBeIn(config('materials.mimetypes'))
            ->and($material->mime_type)->toBe(mime_content_type(base_path("tests/Fixtures/materials/sample.{$ext}")));
        Storage::disk(config('materials.disk'))->assertExists($material->path);
    }

    expect(Material::count())->toBe(count(config('materials.extensions')));
});

test('an uppercase extension is accepted and stored lowercased', function () {
    $this->actingAs(aTeacher());

    $this->post('/api/materials', uploadBody([
        'file' => materialFixture('sample.pdf', 'HANDOUT.PDF'),
    ]))->assertCreated();

    $material = Material::sole();
    expect($material->original_name)->toBe('HANDOUT.PDF')
        ->and($material->path)->toEndWith('.pdf');
});

test('an omitted title falls back to the filename stem, truncated to 160', function () {
    $this->actingAs(aTeacher());

    $this->post('/api/materials', array_diff_key(uploadBody([
        'file' => materialFixture('sample.pdf', 'Week 3 homework.pdf'),
    ]), ['title' => null]))->assertCreated()->assertJsonPath('title', 'Week 3 homework');

    $long = str_repeat('b', 200).'.pdf';
    $this->post('/api/materials', array_diff_key(uploadBody([
        'file' => materialFixture('sample.pdf', $long),
    ]), ['title' => null]))->assertCreated();

    expect(strlen(Material::latest('id')->first()->title))->toBe(160);
});

test('only a teacher may upload or list materials, whatever the body', function () {
    foreach (Role::cases() as $role) {
        if ($role === Role::Teacher) {
            continue;
        }
        $this->actingAs(User::factory()->create(['role' => $role->value]));

        $this->post('/api/materials', uploadBody())->assertStatus(403);
        $this->getJson('/api/materials')->assertStatus(403);
        // The role gate must win over validation: a malformed body from a
        // non-teacher is still 403, never 422.
        $this->postJson('/api/materials', ['title' => ''])->assertStatus(403);
    }

    expect(Material::count())->toBe(0);
});

test('the index lists only the callers materials, newest first, 15 to a page', function () {
    $me = aTeacher();
    foreach (range(1, 16) as $i) {
        aMaterial($me, ['title' => "Mine {$i}"]);
    }
    aMaterial(aTeacher(), ['title' => 'Not mine']);
    $this->actingAs($me);

    $page = $this->getJson('/api/materials')->assertOk()
        ->assertJsonCount(15, 'data')
        ->assertJsonPath('meta.total', 16)
        ->assertJsonPath('data.0.title', 'Mine 16');

    expect(array_keys($page->json('data.0')))->toBe([
        'id', 'title', 'subject', 'grade_level', 'visibility', 'published_at',
        'original_name', 'mime_type', 'size_bytes', 'author',
    ]);

    $this->getJson('/api/materials?page=2')->assertOk()->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.title', 'Mine 1');
});
