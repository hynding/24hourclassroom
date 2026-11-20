<?php

use App\Models\Figure;
use App\Models\Question;
use App\Support\FigurePayload;
use App\Support\SafeSvg;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
    Storage::fake('local');
});

function figureTestBody(array $question = []): array
{
    return [
        'title' => 'Arrays', 'subject' => 'math', 'grade_level' => 'grade-3',
        'questions' => [array_merge(['type' => 'numeric', 'prompt' => 'How many dots?', 'answer' => ['value' => 12, 'tolerance' => 0]], $question)],
    ];
}

/** The signed path the SPA would request, relative to the app. */
function figurePath(string $url): string
{
    return substr($url, strlen(rtrim((string) config('app.url'), '/')));
}

test('a teacher uploads a picture and a student cannot', function () {
    $teacher = aTeacher();

    $res = $this->actingAs($teacher)->post('/api/figures', ['file' => materialFixture('sample.png')], ['Accept' => 'application/json'])
        ->assertCreated()->assertJsonStructure(['id', 'url']);
    $figure = Figure::find($res->json('id'));
    expect($figure->user_id)->toBe($teacher->id)->and($figure->mime_type)->toBe('image/png');
    Storage::disk('local')->assertExists($figure->path);

    $this->actingAs(aStudent())->post('/api/figures', ['file' => materialFixture('sample.png')], ['Accept' => 'application/json'])->assertForbidden();
    $this->actingAs($teacher)->post('/api/figures', ['file' => materialFixture('sample.pdf')], ['Accept' => 'application/json'])
        ->assertStatus(422)->assertJsonValidationErrors('file');
});

test('a question shows its picture through a signed link with its alt text', function () {
    $teacher = aTeacher();
    $figure = Figure::factory()->for($teacher, 'owner')->create();
    Storage::disk('local')->put($figure->path, file_get_contents(base_path('tests/Fixtures/materials/sample.png')));

    $res = $this->actingAs($teacher)->postJson('/api/tests', figureTestBody(['figure_id' => $figure->id, 'figure_alt' => 'Three rows of four dots']))
        ->assertCreated()
        ->assertJsonPath('questions.0.figure.id', $figure->id)
        ->assertJsonPath('questions.0.figure.alt', 'Three rows of four dots');

    $path = figurePath($res->json('questions.0.figure.url'));
    $image = $this->get($path)->assertOk();
    expect($image->headers->get('Content-Type'))->toBe('image/png')
        ->and($image->headers->get('Content-Security-Policy'))->toContain('sandbox')
        ->and($image->headers->get('X-Content-Type-Options'))->toBe('nosniff');

    // A tampered or unsigned link is refused before the id is even looked up.
    $this->get(preg_replace('/signature=[^&]+/', 'signature=nope', $path))->assertForbidden();
    $this->get("/api/figures/{$figure->id}/image")->assertForbidden();
});

test('links built in the same window are identical, so browsers can cache the picture', function () {
    expect(FigurePayload::url(5))->toBe(FigurePayload::url(5));
});

test('a picture needs alt text and must be the author\'s own', function () {
    $teacher = aTeacher();
    $mine = Figure::factory()->for($teacher, 'owner')->create();
    $theirs = Figure::factory()->create();

    $this->actingAs($teacher)->postJson('/api/tests', figureTestBody(['figure_id' => $mine->id]))
        ->assertStatus(422)->assertJsonValidationErrors('questions.0.figure_alt');
    $this->actingAs($teacher)->postJson('/api/tests', figureTestBody(['figure_id' => $theirs->id, 'figure_alt' => 'A bar graph of pets']))
        ->assertStatus(422)->assertJsonValidationErrors('questions.0.figure_id');
});

test('a copy keeps the picture, and its new author may keep it on save', function () {
    $author = aTeacher();
    $figure = Figure::factory()->for($author, 'owner')->create();
    $source = aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()]);
    $source->questions()->first()->update(['figure_id' => $figure->id, 'figure_alt' => 'A number line from 0 to 1']);

    $copier = aTeacher();
    $copy = $this->actingAs($copier)->postJson("/api/tests/{$source->id}/copy")->assertCreated()
        ->assertJsonPath('questions.0.figure.id', $figure->id)->json();

    $q = $copy['questions'][0];
    $body = figureTestBody(['id' => $q['id'], 'figure_id' => $figure->id, 'figure_alt' => 'A number line, halves marked']);
    $this->actingAs($copier)->putJson("/api/tests/{$copy['id']}", $body)->assertOk()
        ->assertJsonPath('questions.0.figure.alt', 'A number line, halves marked');
});

test('the writer drops a picture it may not show, whatever the caller sends', function () {
    $teacher = aTeacher();
    $test = aTestWithQuestions($teacher, 1);
    $theirs = Figure::factory()->create();

    App\Support\TestWriter::syncQuestions($test, figureTestBody(['figure_id' => $theirs->id, 'figure_alt' => 'Someone else\'s'])['questions']);

    expect(Question::where('test_id', $test->id)->first()->figure_id)->toBeNull();
});

test('SafeSvg accepts a plain drawing and rejects anything active or external', function () {
    $ok = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><rect x="1" y="1" width="8" height="8" fill="#fff" stroke="#000"/><text x="2" y="6">3</text></svg>';
    expect(SafeSvg::problem($ok))->toBeNull();

    foreach ([
        '<svg viewBox="0 0 1 1"><script>alert(1)</script></svg>',
        '<svg viewBox="0 0 1 1" onload="x()"></svg>',
        '<svg viewBox="0 0 1 1"><image href="https://x/y.png"/></svg>',
        '<svg viewBox="0 0 1 1"><rect style="fill:url(https://x)"/></svg>',
        '<svg viewBox="0 0 1 1"><a href="javascript:x"></a></svg>',
        '<svg width="1"></svg>',
        '<html><svg viewBox="0 0 1 1"></svg></html>',
    ] as $bad) {
        expect(SafeSvg::problem($bad))->not->toBeNull();
    }
});
