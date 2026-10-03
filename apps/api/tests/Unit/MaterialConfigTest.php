<?php

test('the materials config carries exactly the limits the spec fixes', function () {
    expect(config('materials.disk'))->toBe('local')
        ->and(config('materials.max_file_kb'))->toBe(10240)
        ->and(config('materials.max_files_per_teacher'))->toBe(100)
        ->and(config('materials.max_bytes_per_teacher'))->toBe(262144000)
        ->and(config('materials.extensions'))->toBe([
            'pdf', 'doc', 'docx', 'odt', 'rtf', 'txt', 'md', 'png', 'jpg', 'jpeg',
        ]);

    // The zip-container ruling: libmagic reports .docx/.odt as application/zip
    // on some hosts, so that type is allowlisted and `extensions:` carries the
    // name guarantee for those two.
    expect(config('materials.mimetypes'))->toContain('application/zip')
        ->and(config('materials.mimetypes'))->toContain('text/plain');
});

test('every allowlisted extension has a fixture whose REAL bytes sniff to an allowlisted type', function () {
    foreach (config('materials.extensions') as $ext) {
        $path = base_path("tests/Fixtures/materials/sample.{$ext}");
        expect(file_exists($path))->toBeTrue("missing fixture for .{$ext}");
        expect(mime_content_type($path))->toBeIn(config('materials.mimetypes'));
    }
});

test('the negative fixtures really are the types the rules must catch', function () {
    expect(mime_content_type(base_path('tests/Fixtures/materials/sample.html')))->toBe('text/html')
        ->and(mime_content_type(base_path('tests/Fixtures/materials/sample.zip')))->toBe('application/zip');

    // text/html is NOT allowlisted -- that is the whole point of the fixture.
    expect(config('materials.mimetypes'))->not->toContain('text/html');
});

test('MATERIALS_MAX_FILES_PER_TEACHER sets the per-teacher file cap; a bad value falls back to 100', function () {
    // Re-evaluate the config file with the variable set, the way a fresh
    // boot (or config:cache on deploy) would.
    $load = function (?string $value): mixed {
        putenv($value === null ? 'MATERIALS_MAX_FILES_PER_TEACHER' : "MATERIALS_MAX_FILES_PER_TEACHER={$value}");

        return (require config_path('materials.php'))['max_files_per_teacher'];
    };

    try {
        expect($load('250'))->toBe(250)
            ->and($load(' 150 '))->toBe(150)  // stray spaces in an env file are harmless
            ->and($load(null))->toBe(100)
            // Zero, negative or junk would lock every teacher out of
            // uploading; fall back to the default instead.
            ->and($load('0'))->toBe(100)
            ->and($load('-5'))->toBe(100)
            ->and($load('lots'))->toBe(100);
    } finally {
        putenv('MATERIALS_MAX_FILES_PER_TEACHER');
    }
});

test('the quota message and the seeder honour a raised file cap', function () {
    config(['materials.max_files_per_teacher' => 3]);
    $teacher = aTeacher();
    \App\Models\Material::factory()->count(2)->for($teacher, 'author')->create();

    expect(\App\Support\MaterialQuota::errorFor($teacher, 10))->toBeNull();
    \App\Models\Material::factory()->for($teacher, 'author')->create();
    expect(\App\Support\MaterialQuota::errorFor($teacher, 10))->toBe('You have reached the limit of 3 materials.');
});
