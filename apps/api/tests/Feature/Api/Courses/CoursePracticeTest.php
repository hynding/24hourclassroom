<?php

use App\Models\Answer;
use App\Models\Assignment;
use App\Models\Attempt;
use App\Models\Question;
use App\Models\Test;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

/** A public course holding one public test with a question of each auto- and hand-graded shape. */
function practiceCourse(): array
{
    $author = aTeacher(['name' => 'Ms K']);
    $test = Test::factory()->for($author, 'author')->published()->create(['title' => 'Cells quiz']);
    $questions = [
        Question::factory()->for($test)->create(['position' => 0, 'answer' => 1, 'points' => 2, 'explanation' => 'The powerhouse.', 'option_explanations' => ['No.', 'Yes.', 'No.', 'No.']]),
        Question::factory()->for($test)->multiSelect(partial: true)->create(['position' => 1, 'points' => 2]),
        Question::factory()->for($test)->trueFalse()->create(['position' => 2]),
        Question::factory()->for($test)->numeric(42, 0.5)->create(['position' => 3]),
        Question::factory()->for($test)->fillBlank(['polar'])->create(['position' => 4]),
        Question::factory()->for($test)->shortAnswer()->create(['position' => 5, 'points' => 3]),
    ];
    $course = aCourse($author, [$test], ['title' => 'Biology', 'visibility' => 'public', 'published_at' => now()]);

    return [$course, $test, $questions, $author];
}

test('anyone, logged out included, can practise a public course\'s test with the answers to hand', function () {
    [$course, $test, $questions] = practiceCourse();

    $res = $this->getJson("/api/courses/{$course->id}/tests/{$test->id}")->assertOk()
        ->assertJsonPath('id', $test->id)
        ->assertJsonPath('title', 'Cells quiz')
        ->assertJsonPath('course.id', $course->id)
        ->assertJsonPath('course.title', 'Biology')
        ->assertJsonPath('course.author.name', 'Ms K')
        ->assertJsonCount(6, 'questions')
        ->assertJsonPath('questions.0.answer', 1)
        ->assertJsonPath('questions.0.explanation', 'The powerhouse.')
        ->assertJsonPath('questions.0.option_explanations.1', 'Yes.')
        ->assertJsonPath('questions.4.answer', ['polar']);
    expect($res->json())->not->toHaveKey('is_author');

    // The ordinary test page still keeps its answers to itself.
    expect($this->getJson("/api/tests/{$test->id}")->assertOk()->json('questions.0'))->not->toHaveKey('answer');
});

test('checking a run grades it with the attempt scorer and writes nothing', function () {
    [$course, $test, [$mc, $multi, $tf, $num, $blank, $short]] = practiceCourse();

    // Plain JSON numbers: a whole score encodes without its ".0", so the
    // numeric checks below compare by value, not by PHP type.
    $res = $this->postJson("/api/courses/{$course->id}/tests/{$test->id}/check", ['responses' => [
        $mc->id => 1,              // right: 2
        $multi->id => [0, 1],      // one right, one wrong, partial credit: 0 of 2
        $tf->id => true,           // right: 1
        $num->id => '42.4',        // inside the tolerance: 1
        $blank->id => '  Polar. ', // normalised: 1
        $short->id => 'Light',     // nobody can mark this: null
        999999 => 'ignored',
    ]])->assertOk()
        ->assertJsonPath('max_score', 10)
        ->assertJsonPath('ungraded_count', 1)
        ->assertJsonPath('results.5', ['question_id' => $short->id, 'awarded' => null, 'points' => 3]);
    expect($res->json('score'))->toEqual(5)
        ->and(array_column($res->json('results'), 'question_id'))->toBe([$mc->id, $multi->id, $tf->id, $num->id, $blank->id, $short->id])
        ->and(array_column($res->json('results'), 'awarded'))->toEqual([2, 0, 1, 1, 1, null])
        ->and(array_column($res->json('results'), 'points'))->toBe([2, 2, 1, 1, 1, 3]);

    // Unanswered questions are blanks, not errors.
    $empty = $this->postJson("/api/courses/{$course->id}/tests/{$test->id}/check", ['responses' => []])
        ->assertOk()->assertJsonPath('ungraded_count', 1);
    expect($empty->json('score'))->toEqual(0);

    expect(Attempt::count())->toBe(0)->and(Answer::count())->toBe(0);
});

test('a check refuses an oversized written response', function () {
    [$course, $test, $questions] = practiceCourse();

    $this->postJson("/api/courses/{$course->id}/tests/{$test->id}/check", ['responses' => [$questions[5]->id => str_repeat('a', 10001)]])
        ->assertStatus(422);
    $this->postJson("/api/courses/{$course->id}/tests/{$test->id}/check", [])->assertStatus(422);
});

test('practice is 404 off a private course, for a test the course does not list, and for a private test', function () {
    [$course, $test, , $author] = practiceCourse();
    $elsewhere = Test::factory()->for($author, 'author')->published()->create();
    Question::factory()->for($elsewhere)->create();

    $this->getJson("/api/courses/{$course->id}/tests/{$elsewhere->id}")->assertStatus(404);
    $this->postJson("/api/courses/{$course->id}/tests/{$elsewhere->id}/check", ['responses' => []])->assertStatus(404);
    $this->getJson("/api/courses/{$course->id}/tests/999999")->assertStatus(404);

    // An assigned student can open the private test itself, but its answers
    // only ever travel with a public course AND a public test.
    $test->update(['visibility' => 'private']);
    $student = aStudent();
    connectAccepted($author, $student);
    Assignment::create(['test_id' => $test->id, 'student_id' => $student->id, 'teacher_id' => $author->id]);
    $this->actingAs($student);
    $this->getJson("/api/tests/{$test->id}")->assertOk();
    $this->getJson("/api/courses/{$course->id}/tests/{$test->id}")->assertStatus(404);
    $this->postJson("/api/courses/{$course->id}/tests/{$test->id}/check", ['responses' => []])->assertStatus(404);

    // Private course: nobody but the author, who can preview it.
    $test->update(['visibility' => 'public']);
    $course->update(['visibility' => 'private']);
    $this->getJson("/api/courses/{$course->id}/tests/{$test->id}")->assertStatus(404);
    $this->actingAs($author);
    $this->getJson("/api/courses/{$course->id}/tests/{$test->id}")->assertOk()->assertJsonPath('questions.0.answer', 1);
});
