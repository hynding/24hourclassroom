<?php

use App\Models\Assignment;
use App\Models\Course;
use App\Models\Material;
use App\Models\Question;
use App\Models\Test;
use App\Models\User;
use Database\Seeders\ApBiologySeeder;
use Database\Seeders\ApLiteratureSeeder;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake(config('materials.disk'));
    $this->withHeader('Referer', 'http://localhost:3333');
});

function seedApLitFixture(): void
{
    (new ApLiteratureSeeder(base_path('tests/Fixtures/course-ap-literature')))->run();
}

test('the seeder creates accounts, a connection, published tests with slugged questions, assignments and materials', function () {
    seedApLitFixture();

    $teacher = User::where('email', 'aplit@example.com')->sole();
    $student = User::where('email', 'aplit-student@example.com')->sole();
    expect($teacher->role->value)->toBe('teacher')->and($teacher->email_verified_at)->not->toBeNull()
        ->and($student->role->value)->toBe('student')->and($student->email_verified_at)->not->toBeNull()
        ->and(\App\Models\Connection::acceptedBetween($teacher, $student))->toBeTrue();

    $quiz = Test::where('slug', 'aplit-w01-quiz')->sole();
    expect($quiz->title)->toBe('AP Literature · Week 01 · Quiz · The Story of an Hour')
        ->and($quiz->description)->toStartWith('CED skills 1.A · Unit 1 Short Fiction I')
        ->and($quiz->visibility->value)->toBe('public')
        ->and($quiz->published_at)->not->toBeNull()
        ->and($quiz->user_id)->toBe($teacher->id)
        ->and($quiz->questions->pluck('slug')->all())->toBe(['u01-w01-q01', 'u01-w01-q02'])
        ->and($quiz->questions[0]->stimulus)->toStartWith('Knowing that Mrs. Mallard')
        ->and($quiz->questions[0]->option_explanations[1])->toStartWith('Tempting')
        ->and($quiz->questions[0]->prompt)->toBe('What does the opening sentence establish about Mrs. Mallard?')
        ->and($quiz->questions[1]->answer)->toBe(['third', '3rd'])
        ->and($quiz->subject->value)->toBe('english-language-arts');

    $exam = Test::where('slug', 'aplit-u01-exam')->sole();
    expect($exam->title)->toBe('AP Literature · Week 02 · Unit 1 Exam · Short Fiction I')
        ->and($exam->questions[0]->points)->toBe(6);

    // Assigned to the demo student, due the Sunday ending each week.
    expect(Assignment::where('student_id', $student->id)->count())->toBe(2)
        ->and(Assignment::where('test_id', $quiz->id)->sole()->due_at->toDateString())->toBe('2026-09-06')
        ->and(Assignment::where('test_id', $exam->id)->sole()->due_at->toDateString())->toBe('2026-09-13');

    $guide = Material::where('slug', 'aplit-w01-guide')->sole();
    $deck = Material::where('slug', 'aplit-w01-cards')->sole();
    $summary = Material::where('slug', 'aplit-u01-summary')->sole();
    expect($guide->title)->toBe('AP Literature · Week 01 · Study Guide · The Story of an Hour')
        ->and($guide->original_name)->toBe('week-01-study-guide.md')
        ->and($guide->mime_type)->toBe('text/plain')
        ->and($guide->visibility->value)->toBe('public')
        ->and($deck->original_name)->toBe('week-01.flashcards.md')
        ->and($summary->title)->toBe('AP Literature · Week 02 · Unit 1 Summary · Short Fiction I');
    $deckBody = Storage::disk(config('materials.disk'))->get($deck->path);
    expect($deckBody)->toContain("## Louise Mallard\n")
        ->toContain('Hint: Her heart trouble opens the story.')
        ->toContain("Topic: 1.A\n")
        ->toContain("## Irony\nA gap between what is expected and what happens.");
});

test('the seeder builds a private course of every test and material, in teaching order, under unit headings', function () {
    seedApLitFixture();

    $course = Course::where('slug', ApLiteratureSeeder::COURSE_SLUG)->sole();
    expect($course->title)->toBe('AP Literature (fixture)')
        ->and($course->visibility->value)->toBe('private')
        ->and($course->user_id)->toBe(User::where('email', 'aplit@example.com')->sole()->id)
        ->and($course->subject->value)->toBe('english-language-arts')
        ->and($course->grade_level->value)->toBe('9-12');

    $slugs = $course->items->map(fn ($item) => $item->test?->slug ?? $item->material?->slug)->all();
    expect($slugs)->toBe(['aplit-w01-guide', 'aplit-w01-cards', 'aplit-w01-quiz', 'aplit-u01-summary', 'aplit-u01-exam'])
        ->and($course->items->pluck('section')->unique()->all())->toBe(['Unit 1 · Short Fiction I']);
});

test('a re-run keeps the course, its id and the visibility its owner chose', function () {
    seedApLitFixture();
    $course = Course::sole();
    $course->update(['visibility' => 'public', 'published_at' => now()]);

    seedApLitFixture();

    expect(Course::count())->toBe(1)
        ->and(Course::sole()->id)->toBe($course->id)
        ->and(Course::sole()->visibility->value)->toBe('public')
        ->and(Course::sole()->items()->count())->toBe(5);
});

test('re-running updates in place: same ids, same paths, no duplicates, answers survive', function () {
    seedApLitFixture();
    $quiz = Test::where('slug', 'aplit-w01-quiz')->sole();
    $ids = $quiz->questions->pluck('id')->all();
    $paths = Material::orderBy('id')->pluck('path')->all();
    $student = User::where('email', 'aplit-student@example.com')->sole();

    // A student attempt in between: its answers must still point at live questions.
    $this->actingAs($student);
    $attemptId = $this->postJson("/api/tests/{$quiz->id}/attempts")->json('id');
    $this->putJson("/api/attempts/{$attemptId}", ['responses' => [$ids[1] => 'third']])->assertOk();
    $this->postJson("/api/attempts/{$attemptId}/submit")->assertOk()->assertJsonPath('score', '1.00');

    seedApLitFixture();

    expect(Test::count())->toBe(2)->and(Material::count())->toBe(3)->and(User::count())->toBe(2)
        ->and(Question::withTrashed()->count())->toBe(3)
        ->and(Test::where('slug', 'aplit-w01-quiz')->sole()->questions->pluck('id')->all())->toBe($ids)
        ->and(Material::orderBy('id')->pluck('path')->all())->toBe($paths)
        ->and(Assignment::count())->toBe(2)
        ->and(\App\Models\Connection::count())->toBe(1);
    $this->getJson("/api/attempts/{$attemptId}")->assertOk()->assertJsonPath('score', '1.00');
});

test('a bad item fails loudly with its file and index before anything is written', function () {
    $dir = sys_get_temp_dir().'/aplit-bad-'.uniqid();
    mkdir("{$dir}/unit-01-x", 0777, true);
    copy(base_path('tests/Fixtures/course-ap-literature/course.yaml'), "{$dir}/course.yaml");
    file_put_contents("{$dir}/unit-01-x/week-01.yaml", <<<'YAML'
week: 1
title: Broken
topics: ["1.A"]
quiz:
  questions:
    - { slug: ok-1, type: true_false, topic_code: "1.A", source: s, prompt: p, answer: true }
    - { slug: bad-2, type: multiple_choice, topic_code: "1.A", source: s, prompt: p, options: [a, b], answer: 5 }
YAML);

    expect(fn () => (new ApLiteratureSeeder($dir))->run())
        ->toThrow(RuntimeException::class, 'week-01.yaml question #2 (bad-2)');
    expect(Test::count())->toBe(0)->and(User::count())->toBe(0);
});

test('a seeded question the teacher deleted is restored on the next run, not duplicated', function () {
    seedApLitFixture();
    $quiz = Test::where('slug', 'aplit-w01-quiz')->sole();
    [$kept, $deleted] = $quiz->questions->all();

    // The editor's delete path: a soft delete that leaves the slug on the row.
    $deleted->delete();

    seedApLitFixture();

    expect(Question::withTrashed()->where('test_id', $quiz->id)->count())->toBe(2)
        ->and($quiz->fresh()->questions->pluck('id')->all())->toBe([$kept->id, $deleted->id])
        ->and($deleted->fresh()->trashed())->toBeFalse();
});

test('DatabaseSeeder seeds the literature course beside biology, and is re-runnable', function () {
    // Both course seeders bound to their small fixtures; the fixture tests
    // above prove each seeder's own idempotency.
    app()->bind(ApBiologySeeder::class, fn () => new ApBiologySeeder(base_path('tests/Fixtures/course')));
    app()->bind(ApLiteratureSeeder::class, fn () => new ApLiteratureSeeder(base_path('tests/Fixtures/course-ap-literature')));

    $this->seed();
    $this->seed();

    expect(User::where('email', 'test@example.com')->count())->toBe(1)
        ->and(Test::where('slug', 'like', 'aplit-%')->count())->toBe(2)
        ->and(Material::where('slug', 'like', 'aplit-%')->count())->toBe(3)
        ->and(Course::where('slug', ApLiteratureSeeder::COURSE_SLUG)->count())->toBe(1)
        ->and(Course::count())->toBe(2);
});
