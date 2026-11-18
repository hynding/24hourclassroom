<?php

use App\Models\Assignment;
use App\Models\Attempt;
use App\Models\Question;
use App\Models\Test;
use App\Models\User;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

function gradebookTest(User $teacher, string $title, int $points): Test
{
    $test = Test::factory()->for($teacher, 'author')->create(['title' => $title]);
    Question::factory()->for($test)->create(['position' => 0, 'points' => $points]);

    return $test;
}

function submitted(Assignment $a, float $score, float $max, string $when): Attempt
{
    $attempt = Attempt::create(['test_id' => $a->test_id, 'student_id' => $a->student_id, 'assignment_id' => $a->id, 'started_at' => $when]);
    $attempt->forceFill(['submitted_at' => $when, 'score' => $score, 'max_score' => $max, 'graded_at' => $when])->save();

    return $attempt;
}

function assign(Test $test, User $student, User $teacher, ?string $due = null): Assignment
{
    return Assignment::create(['test_id' => $test->id, 'student_id' => $student->id, 'teacher_id' => $teacher->id, 'due_at' => $due]);
}

test('a test\'s gradebook lists each connected student\'s latest and best', function () {
    $teacher = aTeacher();
    $test = gradebookTest($teacher, 'Cells quiz', 10);
    $ada = aStudent(['name' => 'Ada']);
    $bo = aStudent(['name' => 'Bo']);
    $gone = aStudent(['name' => 'Gone']);
    connectAccepted($teacher, $ada);
    connectAccepted($teacher, $bo);
    $a = assign($test, $ada, $teacher, '2026-11-20 00:00:00');
    assign($test, $bo, $teacher);
    assign($test, $gone, $teacher); // not connected: left out
    submitted($a, 9, 10, '2026-11-10 09:00:00');
    $latest = submitted($a, 6.5, 10, '2026-11-12 09:00:00');
    $latest->answers()->create(['question_id' => $test->questions()->value('id'), 'response' => null]);

    $res = $this->actingAs($teacher)->getJson("/api/tests/{$test->id}/gradebook")->assertOk()
        ->assertJsonPath('title', 'Cells quiz')
        ->assertJsonPath('columns', ['Student', 'Due', 'Submitted', 'Latest score', 'Best score', 'Out of', 'Best %', 'Attempts', 'Answers to grade']);

    expect($res->json('rows'))->toEqual([
        ['Ada', '2026-11-20', '2026-11-12 09:00:00', 6.5, 9, 10, 90, 2, 1],
        ['Bo', null, null, null, null, null, null, 0, null],
    ]);
});

test('a course\'s gradebook puts students against its tests in course order', function () {
    $teacher = aTeacher();
    $quiz = gradebookTest($teacher, 'Week 1 quiz', 10);
    $exam = gradebookTest($teacher, 'Unit 1 exam', 20);
    $course = aCourse($teacher, [$quiz, aMaterial($teacher), $exam]);
    $zed = aStudent(['name' => 'zed']);
    $ada = aStudent(['name' => 'Ada']);
    connectAccepted($teacher, $zed);
    connectAccepted($teacher, $ada);
    submitted(assign($quiz, $ada, $teacher), 8, 10, '2026-11-10 09:00:00');
    submitted(assign($exam, $ada, $teacher), 15, 20, '2026-11-11 09:00:00');
    assign($quiz, $zed, $teacher);

    $res = $this->actingAs($teacher)->getJson("/api/courses/{$course->id}/gradebook")->assertOk();

    expect($res->json('columns'))->toBe(['Student', 'Week 1 quiz (out of 10)', 'Unit 1 exam (out of 20)', 'Tests submitted', 'Points', 'Possible', 'Percent'])
        ->and($res->json('rows'))->toEqual([
            ['Ada', 8, 15, 2, 23, 30, 76.7],
            ['zed', null, null, 0, 0, 0, null],
        ]);
});

test('only the author gets a gradebook', function () {
    $teacher = aTeacher();
    $test = gradebookTest($teacher, 'Quiz', 1);
    $course = aCourse($teacher, [$test]);
    $student = aStudent();
    connectAccepted($teacher, $student);
    assign($test, $student, $teacher);

    $this->actingAs(aTeacher())->getJson("/api/tests/{$test->id}/gradebook")->assertNotFound();
    $this->actingAs($student)->getJson("/api/courses/{$course->id}/gradebook")->assertNotFound();
    $this->actingAs(User::factory()->create(['role' => 'admin']))->getJson("/api/tests/{$test->id}/gradebook")->assertNotFound();
});
