<?php

use App\Models\Material;
use App\Services\MaterialWriter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

beforeEach(function () {
    Storage::fake(config('materials.disk'));
});

test('bytes land like an upload: author folder, random name, sniffed mime, measured size, slug and publish state', function () {
    $teacher = aTeacher();
    $body = "# AP Biology · Week 01 · Study Guide\n\nWater is **polar**.\n";

    $material = MaterialWriter::create($teacher, $body, 'week-01.md', [
        'title' => 'AP Biology · Week 01 · Study Guide',
        'subject' => 'science',
        'grade_level' => '9-12',
        'slug' => 'apbio-w01-guide',
        'visibility' => 'public',
        'published_at' => now(),
    ]);

    expect($material->path)->toStartWith("materials/{$teacher->id}/")
        ->and($material->path)->toEndWith('.md')
        ->and($material->path)->not->toContain('week-01')
        ->and($material->original_name)->toBe('week-01.md')
        ->and($material->mime_type)->toBe('text/plain')
        ->and($material->size_bytes)->toBe(strlen($body))
        ->and($material->slug)->toBe('apbio-w01-guide')
        ->and($material->visibility->value)->toBe('public')
        ->and($material->published_at)->not->toBeNull();
    Storage::disk(config('materials.disk'))->assertExists($material->path);
    expect(Storage::disk(config('materials.disk'))->get($material->path))->toBe($body);
});

test('an omitted title falls back to the filename stem and a stemless name to the full name', function () {
    $teacher = aTeacher();
    $a = MaterialWriter::create($teacher, 'x', 'notes.txt', ['subject' => 'math', 'grade_level' => 'k-2']);
    $b = MaterialWriter::create($teacher, 'x', '.txt', ['subject' => 'math', 'grade_level' => 'k-2']);

    expect($a->title)->toBe('notes')->and($b->title)->toBe('.txt');
});

test('replace overwrites the same path and re-measures, and the quota applies to the growth', function () {
    $teacher = aTeacher();
    $material = MaterialWriter::create($teacher, 'short', 'g.md', ['subject' => 'math', 'grade_level' => 'k-2']);
    $path = $material->path;

    $fresh = MaterialWriter::replace($material, 'a much longer body');

    expect($fresh->path)->toBe($path)
        ->and($fresh->size_bytes)->toBe(strlen('a much longer body'))
        ->and(Storage::disk(config('materials.disk'))->get($path))->toBe('a much longer body');

    config(['materials.max_bytes_per_teacher' => $fresh->size_bytes + 1]);
    expect(fn () => MaterialWriter::replace($fresh, str_repeat('x', $fresh->size_bytes + 2)))->toThrow(ValidationException::class);
    expect(Storage::disk(config('materials.disk'))->get($path))->toBe('a much longer body');
});

test('the file-count quota rejects and leaves no orphan file', function () {
    $teacher = aTeacher();
    config(['materials.max_files_per_teacher' => 1]);
    MaterialWriter::create($teacher, 'one', 'one.md', ['subject' => 'math', 'grade_level' => 'k-2']);

    expect(fn () => MaterialWriter::create($teacher, 'two', 'two.md', ['subject' => 'math', 'grade_level' => 'k-2']))
        ->toThrow(ValidationException::class);

    expect(Material::count())->toBe(1)
        ->and(count(Storage::disk(config('materials.disk'))->allFiles()))->toBe(1);
});

test('the client name is basenamed, stripped of control characters and truncated with its extension kept', function () {
    expect(MaterialWriter::normalizeName("../evil/na\x00me.md"))->toBe('name.md');
    $long = MaterialWriter::normalizeName(str_repeat('a', 300).'.pdf');
    expect(strlen($long))->toBe(255)->and($long)->toEndWith('.pdf');
});
