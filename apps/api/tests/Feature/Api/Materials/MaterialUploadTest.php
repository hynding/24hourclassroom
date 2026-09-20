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

test('an HTML file renamed .pdf is rejected on CONTENT', function () {
    $this->actingAs(aTeacher());

    $this->post('/api/materials', uploadBody(['file' => materialFixture('sample.html', 'trap.pdf')]))
        ->assertStatus(422)
        ->assertJsonPath('errors.file.0', 'That file type is not supported.');

    expect(Material::count())->toBe(0);
    expect(Storage::disk(config('materials.disk'))->allFiles())->toBe([]);
});

test('a real PDF named .exe is rejected on NAME', function () {
    $this->actingAs(aTeacher());

    $this->post('/api/materials', uploadBody(['file' => materialFixture('sample.pdf', 'payload.exe')]))
        ->assertStatus(422)
        ->assertJsonPath('errors.file.0', 'That file type is not supported.');

    expect(Material::count())->toBe(0);
});

test('a zip renamed .docx is accepted -- the documented weakening for zip containers', function () {
    $this->actingAs(aTeacher());

    // libmagic reports .docx and .odt as application/zip on some hosts, so
    // that type is allowlisted and `extensions:` carries the name guarantee
    // for those two. The file downloads as an attachment named .docx and
    // opens as nothing; it is not executable and never served inline.
    $this->post('/api/materials', uploadBody(['file' => materialFixture('sample.zip', 'notes.docx')]))
        ->assertCreated();

    expect(Material::sole()->mime_type)->toBe('application/zip');
});

test('a 300-character client filename is stored truncated to 255', function () {
    $this->actingAs(aTeacher());
    $name = str_repeat('a', 296).'.pdf';
    expect(strlen($name))->toBe(300);

    $this->post('/api/materials', uploadBody(['file' => materialFixture('sample.pdf', $name)]))->assertCreated();

    expect(strlen(Material::sole()->original_name))->toBe(255);
});

test('a missing file reports the size-aware message', function () {
    $this->actingAs(aTeacher());

    $this->postJson('/api/materials', ['title' => 'No file', 'subject' => 'math', 'grade_level' => '3-5'])
        ->assertStatus(422)
        ->assertJsonPath('errors.file.0', 'Choose a file under 10 MB.')
        ->assertJsonCount(1, 'errors.file');
});

test('an UPLOAD_ERR_INI_SIZE upload yields exactly ONE file message, thanks to bail', function () {
    $this->actingAs(aTeacher());

    // What PHP actually delivers when the body exceeds upload_max_filesize:
    // an UploadedFile with the INI_SIZE error and an EMPTY tmp path. Without
    // `bail` this fails required + file + extensions + mimetypes + max at
    // once and errors.file is a five-element array.
    $file = new \Illuminate\Http\UploadedFile('', 'big.pdf', null, UPLOAD_ERR_INI_SIZE, true);

    $this->post('/api/materials', uploadBody(['file' => $file]))
        ->assertStatus(422)
        ->assertJsonCount(1, 'errors.file')
        ->assertJsonPath('errors.file.0', 'Choose a file under 10 MB.');
});

test('the size cap is inclusive: 10240 KB passes and 10241 KB does not', function () {
    $this->actingAs(aTeacher());

    // The ONE place a faked file is right: size is the only thing under test,
    // and UploadedFile::fake() derives its mime type from the filename, which
    // keeps `mimetypes:` satisfied while `max:` does the work.
    $atCap = \Illuminate\Http\UploadedFile::fake()->create('cap.pdf', config('materials.max_file_kb'), 'application/pdf');
    $this->post('/api/materials', uploadBody(['file' => $atCap, 'title' => 'At the cap']))->assertCreated();

    $overCap = \Illuminate\Http\UploadedFile::fake()->create('over.pdf', config('materials.max_file_kb') + 1, 'application/pdf');
    $this->post('/api/materials', uploadBody(['file' => $overCap, 'title' => 'Over the cap']))
        ->assertStatus(422)
        ->assertJsonCount(1, 'errors.file')
        ->assertJsonPath('errors.file.0', 'Choose a file under 10 MB.');

    expect(Material::count())->toBe(1);
});

test('the file-count quota rejects at the boundary and is freed by deleting', function () {
    config(['materials.max_files_per_teacher' => 2]);
    $teacher = aTeacher();
    $this->actingAs($teacher);

    $this->post('/api/materials', uploadBody(['title' => 'One']))->assertCreated();
    $this->post('/api/materials', uploadBody(['title' => 'Two']))->assertCreated();

    $this->post('/api/materials', uploadBody(['title' => 'Three']))
        ->assertStatus(422)
        ->assertJsonPath('errors.file.0', 'You have reached the limit of 2 materials.');

    expect(Material::count())->toBe(2)
        ->and(Storage::disk(config('materials.disk'))->allFiles())->toHaveCount(2);

    // Deleting frees the quota immediately -- materials are hard-deleted.
    $this->deleteJson('/api/materials/'.Material::first()->id)->assertNoContent();
    $this->post('/api/materials', uploadBody(['title' => 'Three, now that there is room']))->assertCreated();
});

test('the byte quota rejects at the boundary and counts only the callers own materials', function () {
    $teacher = aTeacher();
    $fixtureBytes = filesize(base_path('tests/Fixtures/materials/sample.pdf'));
    // Room for exactly one more fixture, minus a byte.
    config(['materials.max_bytes_per_teacher' => (2 * $fixtureBytes) - 1]);

    // Another teacher's usage must not count against this one.
    aMaterial(aTeacher(), ['size_bytes' => 250 * 1048576]);

    $this->actingAs($teacher);
    $this->post('/api/materials', uploadBody(['title' => 'Fits']))->assertCreated();

    $mb = intdiv((2 * $fixtureBytes) - 1, 1048576);
    $this->post('/api/materials', uploadBody(['title' => 'One byte too many']))
        ->assertStatus(422)
        ->assertJsonPath('errors.file.0', "This file would take your materials over {$mb} MB.");

    expect(Material::where('user_id', $teacher->id)->count())->toBe(1);
});

test('the locked re-check inside the transaction catches a row that landed after the friendly check', function () {
    config(['materials.max_files_per_teacher' => 1]);
    $teacher = aTeacher();
    $this->actingAs($teacher);

    // Simulate the parallel upload: DB::listen fires AFTER each query, so
    // slipping the row in when the lockForUpdate select runs places it
    // exactly between the request's friendly check (which saw 0 rows and
    // passed) and the transaction's authoritative count.
    $inserted = false;
    \Illuminate\Support\Facades\DB::listen(function ($query) use (&$inserted, $teacher) {
        if ($inserted || ! str_contains(strtolower($query->sql), 'for update')) {
            return;
        }
        $inserted = true;
        \Illuminate\Support\Facades\DB::table('materials')->insert([
            'user_id' => $teacher->id,
            'title' => 'Raced in',
            'description' => null,
            'subject' => 'math',
            'grade_level' => '3-5',
            'visibility' => 'private',
            'original_name' => 'raced.pdf',
            'path' => 'materials/'.$teacher->id.'/raced.pdf',
            'mime_type' => 'application/pdf',
            'size_bytes' => 10,
            'published_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    });

    $this->post('/api/materials', uploadBody(['title' => 'Loses the race']))
        ->assertStatus(422)
        ->assertJsonPath('errors.file.0', 'You have reached the limit of 1 materials.');

    expect($inserted)->toBeTrue()
        ->and(Material::where('title', 'Loses the race')->exists())->toBeFalse()
        // The just-stored file is removed again when the transaction throws.
        ->and(Storage::disk(config('materials.disk'))->allFiles())->toBe([]);
});

test('a storeAs that returns false is a 500 with no row written', function () {
    $this->actingAs(aTeacher());

    // The disk is throw => false: a failed write RETURNS false. Without the
    // abort_if, a row with an empty path would commit and 201.
    $mocked = Mockery::mock(Storage::disk(config('materials.disk')))->makePartial();
    $mocked->shouldReceive('putFileAs')->andReturn(false);
    Storage::set(config('materials.disk'), $mocked);

    $this->post('/api/materials', uploadBody())->assertStatus(500);

    expect(Material::count())->toBe(0);
});

test('a row insert that throws leaves no file behind', function () {
    $this->actingAs(aTeacher());

    // The model event dispatcher is rebuilt per test, so this listener dies
    // with the application instance.
    Material::creating(fn () => throw new RuntimeException('insert exploded'));

    $this->post('/api/materials', uploadBody())->assertStatus(500);

    expect(Material::count())->toBe(0)
        ->and(Storage::disk(config('materials.disk'))->allFiles())->toBe([]);
});

test('a client filename with no stem falls back to the full name as the title', function () {
    $this->actingAs(aTeacher());

    $this->post('/api/materials', array_diff_key(uploadBody([
        'file' => materialFixture('sample.pdf', '.pdf'),
    ]), ['title' => null]))->assertCreated()->assertJsonPath('title', '.pdf');
});

test('a 300-character client filename is stored truncated to 255 with the extension kept', function () {
    $this->actingAs(aTeacher());
    $name = str_repeat('a', 296).'.pdf';
    expect(strlen($name))->toBe(300);

    $this->post('/api/materials', uploadBody(['file' => materialFixture('sample.pdf', $name)]))->assertCreated();

    $stored = Material::sole()->original_name;
    expect(strlen($stored))->toBe(255)
        ->and($stored)->toEndWith('.pdf');
});

test('a body larger than post_max_size is a 413 before validation ever runs', function () {
    $limit = ini_get('post_max_size');
    $bytes = (int) $limit * match (strtoupper(substr($limit, -1))) {
        'G' => 1073741824, 'M' => 1048576, 'K' => 1024, default => 1,
    };

    // A host with post_max_size=0 (unlimited) cannot produce this status.
    if ($bytes <= 0) {
        $this->markTestSkipped('post_max_size is unlimited on this host');
    }

    $this->actingAs(aTeacher());

    // Laravel's global ValidatePostSize compares CONTENT_LENGTH against the
    // ini value and throws before any route middleware. Apache's own
    // LimitRequestBody, if set, returns an HTML 413 even earlier, which the
    // api-client already tolerates as a non-JSON error.
    $this->call('POST', '/api/materials', [], [], [], [
        'CONTENT_LENGTH' => (string) ($bytes + 1),
        'HTTP_ACCEPT' => 'application/json',
        'HTTP_REFERER' => 'http://localhost:3333',
    ])->assertStatus(413);
});
