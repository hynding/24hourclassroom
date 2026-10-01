<?php

use App\Models\Assignment;
use App\Models\Material;
use App\Models\Question;
use App\Models\Test;
use App\Models\User;
use Database\Seeders\ApBiologySeeder;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake(config('materials.disk'));
    $this->withHeader('Referer', 'http://localhost:3333');
});

function seedFixtureCourse(): void
{
    (new ApBiologySeeder(base_path('tests/Fixtures/course')))->run();
}

test('the seeder creates accounts, a connection, published tests with slugged questions, assignments and materials', function () {
    seedFixtureCourse();

    $teacher = User::where('email', 'apbio@example.com')->sole();
    $student = User::where('email', 'apbio-student@example.com')->sole();
    expect($teacher->role->value)->toBe('teacher')->and($teacher->email_verified_at)->not->toBeNull()
        ->and($student->role->value)->toBe('student')->and($student->email_verified_at)->not->toBeNull()
        ->and(\App\Models\Connection::acceptedBetween($teacher, $student))->toBeTrue();

    $quiz = Test::where('slug', 'apbio-w01-quiz')->sole();
    expect($quiz->title)->toBe('AP Biology · Week 01 · Quiz · Water')
        ->and($quiz->description)->toStartWith('CED topics 1.1 · Unit 1 Chemistry of Life')
        ->and($quiz->visibility->value)->toBe('public')
        ->and($quiz->published_at)->not->toBeNull()
        ->and($quiz->user_id)->toBe($teacher->id)
        ->and($quiz->questions->pluck('slug')->all())->toBe(['u01-w01-q01', 'u01-w01-q02'])
        ->and($quiz->questions[0]->stimulus)->toStartWith('| Liquid')
        ->and($quiz->questions[0]->option_explanations[1])->toStartWith('Tempting')
        ->and($quiz->questions[0]->prompt)->toBe('Which property of water best explains the table?')
        ->and($quiz->questions[1]->answer)->toBe(['polar']);

    $exam = Test::where('slug', 'apbio-u01-exam')->sole();
    expect($exam->title)->toBe('AP Biology · Week 02 · Unit 1 Exam · Chemistry of Life')
        ->and($exam->questions[0]->points)->toBe(6);

    // Assigned to the demo student, due the Sunday ending each week.
    expect(Assignment::where('student_id', $student->id)->count())->toBe(2)
        ->and(Assignment::where('test_id', $quiz->id)->sole()->due_at->toDateString())->toBe('2026-09-06')
        ->and(Assignment::where('test_id', $exam->id)->sole()->due_at->toDateString())->toBe('2026-09-13');

    $guide = Material::where('slug', 'apbio-w01-guide')->sole();
    $deck = Material::where('slug', 'apbio-w01-cards')->sole();
    $summary = Material::where('slug', 'apbio-u01-summary')->sole();
    expect($guide->title)->toBe('AP Biology · Week 01 · Study Guide · Water')
        ->and($guide->original_name)->toBe('week-01-study-guide.md')
        ->and($guide->mime_type)->toBe('text/plain')
        ->and($guide->visibility->value)->toBe('public')
        ->and($deck->original_name)->toBe('week-01.flashcards.md')
        ->and($summary->title)->toBe('AP Biology · Week 02 · Unit 1 Summary · Chemistry of Life');
    $deckBody = Storage::disk(config('materials.disk'))->get($deck->path);
    expect($deckBody)->toContain("## Hydrogen bond\n")
        ->toContain('Hint: Think of water beading on a leaf.')
        ->toContain("Topic: 1.1\n")
        ->toContain("## Cohesion\nWater molecules sticking to one another.");
});

test('re-running updates in place: same ids, same paths, no duplicates, answers survive', function () {
    seedFixtureCourse();
    $quiz = Test::where('slug', 'apbio-w01-quiz')->sole();
    $ids = $quiz->questions->pluck('id')->all();
    $paths = Material::orderBy('id')->pluck('path')->all();
    $student = User::where('email', 'apbio-student@example.com')->sole();

    // A student attempt in between: its answers must still point at live questions.
    $this->actingAs($student);
    $attemptId = $this->postJson("/api/tests/{$quiz->id}/attempts")->json('id');
    $this->putJson("/api/attempts/{$attemptId}", ['responses' => [$ids[1] => 'polar']])->assertOk();
    $this->postJson("/api/attempts/{$attemptId}/submit")->assertOk()->assertJsonPath('score', '1.00');

    seedFixtureCourse();

    expect(Test::count())->toBe(2)->and(Material::count())->toBe(3)->and(User::count())->toBe(2)
        ->and(Question::withTrashed()->count())->toBe(3)
        ->and(Test::where('slug', 'apbio-w01-quiz')->sole()->questions->pluck('id')->all())->toBe($ids)
        ->and(Material::orderBy('id')->pluck('path')->all())->toBe($paths)
        ->and(Assignment::count())->toBe(2)
        ->and(\App\Models\Connection::count())->toBe(1);
    $this->getJson("/api/attempts/{$attemptId}")->assertOk()->assertJsonPath('score', '1.00');
});

test('a bad item fails loudly with its file and index before anything is written', function () {
    $dir = sys_get_temp_dir().'/apbio-bad-'.uniqid();
    mkdir("{$dir}/unit-01-x", 0777, true);
    copy(base_path('tests/Fixtures/course/course.yaml'), "{$dir}/course.yaml");
    file_put_contents("{$dir}/unit-01-x/week-01.yaml", <<<'YAML'
week: 1
title: Broken
topics: ["1.1"]
quiz:
  questions:
    - { slug: ok-1, type: true_false, topic_code: "1.1", source: s, prompt: p, answer: true }
    - { slug: bad-2, type: multiple_choice, topic_code: "1.1", source: s, prompt: p, options: [a, b], answer: 5 }
YAML);

    expect(fn () => (new ApBiologySeeder($dir))->run())
        ->toThrow(RuntimeException::class, 'week-01.yaml question #2 (bad-2)');
    expect(Test::count())->toBe(0)->and(User::count())->toBe(0);
});

test('DatabaseSeeder is re-runnable', function () {
    // The real course directory may be empty or partial at any point in
    // the content work; this only proves the top-level seeder tolerates a
    // second run.
    $this->seed();
    $this->seed();
    expect(User::where('email', 'test@example.com')->count())->toBe(1);
});
