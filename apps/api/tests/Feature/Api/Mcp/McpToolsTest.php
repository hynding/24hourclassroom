<?php

use App\Enums\GradeLevel;
use App\Enums\QuestionType;
use App\Enums\Role;
use App\Enums\Subject;
use App\Enums\Visibility;
use App\Mcp\Servers\TeacherServer;
use App\Mcp\Tools\CreateTestDraft;
use App\Mcp\Tools\GetMaterial;
use App\Mcp\Tools\ListMaterials;
use App\Mcp\Tools\ListTaxonomies;
use App\Mcp\Tools\ListTests;
use App\Models\Connection;
use App\Models\Material;
use App\Models\Question;
use App\Models\Test;
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

test('get_material returns the text of a plain-text material', function () {
    $teacher = aTeacher();
    $material = aMaterial($teacher, [
        'mime_type' => 'text/plain',
        'original_name' => 'notes.txt',
        'description' => 'Two paragraphs on cells.',
    ]);
    Storage::disk(config('materials.disk'))->put($material->path, "Cells have membranes.\nMitochondria make ATP.\n");
    $material->update(['size_bytes' => Storage::disk(config('materials.disk'))->size($material->path)]);

    $this->actingAs($teacher);

    TeacherServer::tool(GetMaterial::class, ['id' => $material->id])
        ->assertOk()
        ->assertStructuredContent(fn (AssertableJson $json) => $json
            ->where('id', $material->id)
            ->where('original_name', 'notes.txt')
            ->where('description', 'Two paragraphs on cells.')
            ->where('text', "Cells have membranes.\nMitochondria make ATP.\n")
            ->where('truncated', false)
            ->missing('download_url')
            ->etc());
});

test('get_material truncates a long text on a character boundary', function () {
    $teacher = aTeacher();
    $material = aMaterial($teacher, ['mime_type' => 'text/plain', 'original_name' => 'long.txt']);

    // The multibyte character straddles the 200 000-byte cut: bytes
    // 200 000..200 002 are one 3-byte euro sign, so a naive substr would
    // hand the model a broken UTF-8 sequence.
    $body = str_repeat('a', 199_999).'€'.str_repeat('b', 10);
    Storage::disk(config('materials.disk'))->put($material->path, $body);
    $material->update(['size_bytes' => strlen($body)]);

    $this->actingAs($teacher);

    // A 200 KB string does not belong in an expectation literal, so the
    // closure form reads the value out of the payload and asserts on it.
    TeacherServer::tool(GetMaterial::class, ['id' => $material->id])
        ->assertOk()
        ->assertStructuredContent(function (AssertableJson $json) {
            $text = $json->toArray()['text'];

            expect(mb_check_encoding($text, 'UTF-8'))->toBeTrue();
            expect(strlen($text))->toBeLessThanOrEqual(200_000);
            // The partial euro sign was dropped, not handed over broken.
            expect(str_ends_with($text, 'a'))->toBeTrue();

            $json->where('truncated', true)->etc();
        });
});

test('get_material sanitises text that was never valid utf-8', function () {
    // finfo happily calls a latin-1 .txt file text/plain -- it inspects
    // bytes, not encoding. mb_strcut only fixes a split multibyte
    // character; it does nothing for bytes that were never UTF-8 at all.
    $teacher = aTeacher();
    $material = aMaterial($teacher, ['mime_type' => 'text/plain', 'original_name' => 'latin1.txt']);

    $body = "caf\xE9 au lait";
    Storage::disk(config('materials.disk'))->put($material->path, $body);
    $material->update(['size_bytes' => strlen($body)]);

    $this->actingAs($teacher);

    TeacherServer::tool(GetMaterial::class, ['id' => $material->id])
        ->assertOk()
        ->assertStructuredContent(fn (AssertableJson $json) => $json
            ->where('text', fn ($text) => mb_check_encoding($text, 'UTF-8'))
            ->etc());
});

test('get_material returns a signed download url for a pdf', function () {
    $teacher = aTeacher();
    $material = aMaterial($teacher);   // the pdf fixture, mime application/pdf

    $this->actingAs($teacher);

    TeacherServer::tool(GetMaterial::class, ['id' => $material->id])
        ->assertOk()
        ->assertStructuredContent(function (AssertableJson $json) use ($material, $teacher) {
            $url = $json->toArray()['download_url'];
            expect($url)->toContain("/api/materials/{$material->id}/file")
                ->toContain('signature=')
                ->toContain("viewer={$teacher->id}");

            // A binary file never carries `text` or `truncated`.
            $json->missing('text')->missing('truncated')->etc();
        });
});

test('get_material hides a material the teacher cannot view', function () {
    $teacher = aTeacher();
    $private = Material::factory()->for(aTeacher(), 'author')->create();

    $this->actingAs($teacher);

    TeacherServer::tool(GetMaterial::class, ['id' => $private->id])->assertHasErrors(['Not found.']);
    TeacherServer::tool(GetMaterial::class, ['id' => 999_999])->assertHasErrors(['Not found.']);
});

test('get_material rejects a non-int id instead of coercing it', function () {
    $this->actingAs(aTeacher());

    TeacherServer::tool(GetMaterial::class, ['id' => [5]])->assertHasErrors(['Not found.']);
});

test('get_material reports a missing disk object as not found', function () {
    // The row survives a lost file (a botched restore, a manual delete);
    // that is a 404-shaped answer, not a 500.
    $teacher = aTeacher();
    $material = Material::factory()->for($teacher, 'author')->create([
        'mime_type' => 'text/plain',
        'original_name' => 'gone.txt',
    ]);

    $this->actingAs($teacher);

    TeacherServer::tool(GetMaterial::class, ['id' => $material->id])->assertHasErrors(['Not found.']);
});

test('list_taxonomies returns the enums in order with the shape table', function () {
    $this->actingAs(aTeacher());

    TeacherServer::tool(ListTaxonomies::class)
        ->assertOk()
        ->assertStructuredContent(function (AssertableJson $json) {
            $payload = $json->toArray();

            expect(array_column($payload['subjects'], 'value'))->toBe(array_column(Subject::cases(), 'value'));
            expect(array_column($payload['grade_levels'], 'value'))->toBe(array_column(GradeLevel::cases(), 'value'));
            expect(array_column($payload['question_types'], 'value'))->toBe(array_column(QuestionType::cases(), 'value'));
            expect($payload['subjects'][0]['label'])->toBe('Math');

            foreach (QuestionType::cases() as $type) {
                expect($payload['shapes'])->toHaveKey($type->value);
                expect(array_keys($payload['shapes'][$type->value]))
                    ->toBe(['options', 'answer', 'extras', 'valid']);
            }

            $json->etc();
        });
});

test('list_tests lists only the teachers own tests, newest first', function () {
    $teacher = aTeacher();
    Test::factory()->count(16)->for($teacher, 'author')->create();
    $newest = aTestWithQuestions($teacher, 2, ['title' => 'Fractions quiz']);
    $foreign = aTestWithQuestions(aTeacher(), 1, ['title' => 'Someone elses quiz']);

    $this->actingAs($teacher);

    TeacherServer::tool(ListTests::class)
        ->assertOk()
        ->assertDontSee('Someone elses quiz')
        ->assertStructuredContent(fn (AssertableJson $json) => $json
            ->has('data', 15)
            ->where('data.0.id', $newest->id)
            ->where('data.0.title', 'Fractions quiz')
            ->where('data.0.question_count', 2)
            ->where('meta.total', 17)
            ->where('meta.last_page', 2)
            ->etc());

    expect($foreign->author->id)->not->toBe($teacher->id);
});

test('create_test_draft creates a private test owned by the caller', function () {
    config(['app.frontend_urls' => 'http://localhost:3333']);

    $teacher = aTeacher();
    $this->actingAs($teacher);

    $response = TeacherServer::tool(CreateTestDraft::class, validDraftBody())->assertOk();

    $test = Test::query()->latest('id')->first();

    $response->assertStructuredContent([
        'id' => $test->id,
        'title' => 'Fractions warm-up',
        'question_count' => 5,
        'url' => "http://localhost:3333/tests/{$test->id}/edit",
    ]);

    expect($test->user_id)->toBe($teacher->id);
    expect($test->visibility)->toBe(Visibility::Private);
    expect($test->published_at)->toBeNull();

    // Positions rewritten 0..n-1 and the answers stored as C1 stores them.
    $questions = $test->questions()->get();
    expect($questions->pluck('position')->all())->toBe([0, 1, 2, 3, 4]);
    expect($questions->pluck('type.value')->all())
        ->toBe(['multiple_choice', 'multi_select', 'true_false', 'short_answer', 'numeric']);
    expect($questions[0]->answer)->toBe(1);
    expect($questions[1]->answer)->toBe([1, 2]);
    expect($questions[1]->partial_credit)->toBeTrue();
    expect($questions[2]->answer)->toBeTrue();
    expect($questions[3]->answer)->toBe('1/2');
    expect($questions[4]->answer)->toBe(['value' => 2, 'tolerance' => 0]);
});

test('create_test_draft ignores a question id from another test', function () {
    $teacher = aTeacher();
    $victim = aTestWithQuestions(aTeacher(), 1, ['title' => 'Untouched']);
    $victimQuestion = $victim->questions()->first();
    $before = $victimQuestion->prompt;

    $this->actingAs($teacher);

    TeacherServer::tool(CreateTestDraft::class, validDraftBody(['questions' => [
        ['id' => $victimQuestion->id, 'type' => 'true_false', 'prompt' => 'Overwrite attempt', 'answer' => false],
    ]]))->assertOk();

    // TestWriter scopes every id lookup to the test it is writing, so the
    // foreign id created a NEW row and left the other test alone.
    expect($victimQuestion->fresh()->prompt)->toBe($before);
    expect($victim->fresh()->questions()->count())->toBe(1);
    expect(Question::where('prompt', 'Overwrite attempt')->count())->toBe(1);
});

test('create_test_draft reports every shape violation in one error', function () {
    $this->actingAs(aTeacher());

    TeacherServer::tool(CreateTestDraft::class, validDraftBody(['questions' => [
        ['type' => 'multiple_choice', 'prompt' => 'Out of range', 'options' => ['a', 'b'], 'answer' => 5],
        ['type' => 'true_false', 'prompt' => 'Options it may not have', 'options' => ['a', 'b'], 'answer' => true],
        ['type' => 'numeric', 'prompt' => 'Negative tolerance', 'answer' => ['value' => 1, 'tolerance' => -1]],
    ]]))->assertHasErrors([
        'The answer must be the index of one option.',
        'This question type does not take options.',
        'The answer must be {value, tolerance >= 0}.',
    ]);

    expect(Test::count())->toBe(0);
});

test('create_test_draft never honours a visibility in the body', function () {
    $this->actingAs(aTeacher());

    TeacherServer::tool(CreateTestDraft::class, validDraftBody(['visibility' => 'public']))->assertOk();

    $test = Test::query()->latest('id')->first();
    expect($test->visibility)->toBe(Visibility::Private);
    expect($test->published_at)->toBeNull();
});

test('every non-teacher role is refused by create_test_draft', function () {
    // The only tool that writes -- worth its own loop even though the
    // allowlist check itself is shared with every other tool via TeachersOnly.
    foreach (Role::cases() as $role) {
        if ($role === Role::Teacher) {
            continue;
        }

        $this->actingAs(User::factory()->create(['role' => $role->value]));

        TeacherServer::tool(CreateTestDraft::class, validDraftBody())
            ->assertHasErrors(['Only teachers can use this server.']);
    }

    expect(Test::count())->toBe(0);
});

test('the server registers all five tools', function () {
    TeacherServer::tools()->assertRegistered([
        ListMaterials::class,
        GetMaterial::class,
        ListTaxonomies::class,
        ListTests::class,
        CreateTestDraft::class,
    ]);
});
