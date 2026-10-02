<?php

use App\Models\Answer;
use App\Models\Assignment;
use App\Models\Question;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

function gradedSetup(): array
{
    $teacher = aTeacher();
    $test = aTestWithQuestions($teacher, 0);
    $mc = Question::factory()->for($test)->create(['position' => 0]);
    $sa = Question::factory()->for($test)->shortAnswer()->create(['position' => 1, 'points' => 5]);
    $student = aStudent();
    connectAccepted($teacher, $student);
    $assignment = Assignment::create(['test_id' => $test->id, 'student_id' => $student->id, 'teacher_id' => $teacher->id]);

    return compact('teacher', 'test', 'mc', 'sa', 'student', 'assignment');
}

test('the assigning teacher grades a short answer and the score and graded_at update', function () {
    ['teacher' => $teacher, 'test' => $test, 'mc' => $mc, 'sa' => $sa, 'student' => $student] = gradedSetup();
    $this->actingAs($student);
    $id = $this->postJson("/api/tests/{$test->id}/attempts")->json('id');
    $this->putJson("/api/attempts/{$id}", ['responses' => [$mc->id => 0, $sa->id => 'sunlight']]);
    $this->postJson("/api/attempts/{$id}/submit")->assertOk()->assertJsonPath('graded_at', null);
    $saRow = Answer::where('attempt_id', $id)->where('question_id', $sa->id)->first();
    $mcRow = Answer::where('attempt_id', $id)->where('question_id', $mc->id)->first();

    $this->actingAs($teacher);
    $this->putJson("/api/attempts/{$id}/answers/{$saRow->id}", ['awarded' => 6])->assertStatus(422);
    $this->putJson("/api/attempts/{$id}/answers/{$saRow->id}", ['awarded' => -1])->assertStatus(422);
    $this->putJson("/api/attempts/{$id}/answers/{$mcRow->id}", ['awarded' => 1])->assertStatus(422);

    $res = $this->putJson("/api/attempts/{$id}/answers/{$saRow->id}", ['awarded' => 3.5])->assertOk();
    expect($res->json('score'))->toBe('4.50')
        ->and($res->json('ungraded_count'))->toBe(0)
        ->and($res->json('graded_at'))->not->toBeNull()
        ->and($saRow->fresh()->graded_by)->toBe($teacher->id);
});

test('nobody else can grade: 404 for strangers, the student, and after disconnect', function () {
    ['teacher' => $teacher, 'test' => $test, 'sa' => $sa, 'student' => $student] = gradedSetup();
    $this->actingAs($student);
    $id = $this->postJson("/api/tests/{$test->id}/attempts")->json('id');
    $this->postJson("/api/attempts/{$id}/submit");
    $row = Answer::where('attempt_id', $id)->where('question_id', $sa->id)->first();

    $this->putJson("/api/attempts/{$id}/answers/{$row->id}", ['awarded' => 1])->assertStatus(404);
    $this->actingAs(aTeacher());
    $this->putJson("/api/attempts/{$id}/answers/{$row->id}", ['awarded' => 1])->assertStatus(404);
    \App\Models\Connection::query()->delete();
    $this->actingAs($teacher);
    $this->putJson("/api/attempts/{$id}/answers/{$row->id}", ['awarded' => 1])->assertStatus(404);
});

test('an unsubmitted attempt cannot be graded', function () {
    ['teacher' => $teacher, 'test' => $test, 'sa' => $sa, 'student' => $student] = gradedSetup();
    $this->actingAs($student);
    $id = $this->postJson("/api/tests/{$test->id}/attempts")->json('id');
    $this->putJson("/api/attempts/{$id}", ['responses' => [$sa->id => 'x']]);
    $row = Answer::where('attempt_id', $id)->first();
    $this->actingAs($teacher);
    $this->putJson("/api/attempts/{$id}/answers/{$row->id}", ['awarded' => 1])->assertStatus(409);
});

test('the author sees assigned attempts grouped by student, paginated, excluding self-practice', function () {
    ['teacher' => $teacher, 'test' => $test, 'student' => $student] = gradedSetup();
    $test->update(['visibility' => 'public', 'published_at' => now()]);
    $this->actingAs($student);
    $a1 = $this->postJson("/api/tests/{$test->id}/attempts")->json('id');
    $this->postJson("/api/attempts/{$a1}/submit");
    $a2 = $this->postJson("/api/tests/{$test->id}/attempts")->json('id');
    $this->postJson("/api/attempts/{$a2}/submit");
    $this->actingAs(aStudent()); // self-practice, not connected
    $p = $this->postJson("/api/tests/{$test->id}/attempts")->json('id');
    $this->postJson("/api/attempts/{$p}/submit");

    $this->actingAs($teacher);
    $res = $this->getJson("/api/tests/{$test->id}/attempts")->assertOk()->assertJsonCount(1, 'data')->assertJsonPath('meta.total', 1);
    expect($res->json('data.0.student.id'))->toBe($student->id)
        ->and($res->json('data.0.attempts'))->toHaveCount(2)
        ->and($res->json('data.0.latest.id'))->toBe($a2);

    $this->actingAs(aTeacher());
    $this->getJson("/api/tests/{$test->id}/attempts")->assertStatus(403);
});

test('hand grading is allowlisted by type: every case is either gradable or 422', function () {
    $teacher = aTeacher();
    $test = aTestWithQuestions($teacher, 0);
    $student = aStudent();
    connectAccepted($teacher, $student);
    Assignment::create(['test_id' => $test->id, 'student_id' => $student->id, 'teacher_id' => $teacher->id]);

    $questions = [];
    foreach (\App\Enums\QuestionType::cases() as $i => $type) {
        $factory = Question::factory()->for($test);
        $factory = match ($type) {
            \App\Enums\QuestionType::MultipleChoice => $factory,
            \App\Enums\QuestionType::MultiSelect => $factory->multiSelect(),
            \App\Enums\QuestionType::TrueFalse => $factory->trueFalse(),
            \App\Enums\QuestionType::ShortAnswer => $factory->shortAnswer(),
            \App\Enums\QuestionType::Numeric => $factory->numeric(),
            \App\Enums\QuestionType::FillBlank => $factory->fillBlank(),
            \App\Enums\QuestionType::LongAnswer => $factory->longAnswer(),
        };
        $questions[$type->value] = $factory->create(['position' => $i]);
    }

    $this->actingAs($student);
    $id = $this->postJson("/api/tests/{$test->id}/attempts")->json('id');
    $this->putJson("/api/attempts/{$id}", ['responses' => [$questions['fill_blank']->id => 'nonpolar']])->assertOk();
    $this->postJson("/api/attempts/{$id}/submit")->assertOk();

    $this->actingAs($teacher);
    foreach ($questions as $value => $q) {
        $row = Answer::where('attempt_id', $id)->where('question_id', $q->id)->first();
        $res = $this->putJson("/api/attempts/{$id}/answers/{$row->id}", ['awarded' => 1]);
        if (\App\Enums\QuestionType::from($value)->allowsManualGrade()) {
            $res->assertOk();
        } else {
            $res->assertStatus(422);
        }
    }

    // The fill_blank override replaced its automatic zero.
    $fb = Answer::where('attempt_id', $id)->where('question_id', $questions['fill_blank']->id)->first();
    expect((float) $fb->awarded)->toBe(1.0)->and($fb->graded_by)->toBe($teacher->id);
});
