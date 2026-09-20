<?php

use App\Enums\GradeLevel;
use App\Enums\Subject;
use App\Enums\Visibility;
use App\Models\Material;
use App\Models\MaterialShare;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake(config('materials.disk'));
});

test('aMaterial() creates a private row for its author with real bytes on the configured disk', function () {
    $author = aTeacher();
    $material = aMaterial($author);

    expect($material->user_id)->toBe($author->id)
        ->and($material->visibility)->toBe(Visibility::Private)
        ->and($material->isPublic())->toBeFalse()
        ->and($material->subject)->toBeInstanceOf(Subject::class)
        ->and($material->grade_level)->toBeInstanceOf(GradeLevel::class)
        ->and($material->size_bytes)->toBeInt()
        ->and($material->mime_type)->toBe('application/pdf')
        ->and($material->path)->toStartWith("materials/{$author->id}/")
        ->and($material->author->id)->toBe($author->id)
        ->and($author->materials()->count())->toBe(1);

    Storage::disk(config('materials.disk'))->assertExists($material->path);
    expect(Storage::disk(config('materials.disk'))->get($material->path))
        ->toBe(file_get_contents(base_path('tests/Fixtures/materials/sample.pdf')));
});

test('the published() state stamps published_at and flips isPublic', function () {
    $material = aMaterial(aTeacher(), ['visibility' => 'public', 'published_at' => now()]);

    expect($material->isPublic())->toBeTrue()
        ->and($material->published_at)->not->toBeNull()
        ->and(Material::factory()->published()->create()->isPublic())->toBeTrue();
});

test('shareWith() creates one share row the material owns', function () {
    $material = aMaterial(aTeacher());
    $student = aStudent();
    $share = shareWith($material, $student);

    expect($share->material_id)->toBe($material->id)
        ->and($share->user_id)->toBe($student->id)
        ->and($material->shares()->count())->toBe(1)
        ->and($share->user->id)->toBe($student->id)
        ->and($share->material->id)->toBe($material->id);
});

test('deleting a material cascades its shares, and deleting a user cascades their materials', function () {
    $author = aTeacher();
    $material = aMaterial($author);
    shareWith($material, aStudent());

    $material->delete();
    expect(MaterialShare::count())->toBe(0);

    $second = aMaterial($author);
    shareWith($second, aStudent());
    $author->delete();
    expect(Material::count())->toBe(0)->and(MaterialShare::count())->toBe(0);
});

test('materialFixture() hands back a real UploadedFile whose mime type is sniffed from content', function () {
    $file = materialFixture('sample.html', 'trap.pdf');

    expect($file->getClientOriginalName())->toBe('trap.pdf')
        ->and($file->getClientOriginalExtension())->toBe('pdf')
        ->and($file->getMimeType())->toBe('text/html');
});
