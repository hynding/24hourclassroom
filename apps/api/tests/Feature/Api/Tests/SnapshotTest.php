<?php

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('editing or removing a question after grading leaves the attempt untouched', function () {
    $teacher = aTeacher();
    $test = aTestWithQuestions($teacher, 2); // both MC, answer 0, 1 point
    [$q1, $q2] = $test->questions->all();
    $student = aStudent();
    connectAccepted($teacher, $student);
    \App\Models\Assignment::create(['test_id' => $test->id, 'student_id' => $student->id, 'teacher_id' => $teacher->id]);
    $this->actingAs($student);
    $id = $this->postJson("/api/tests/{$test->id}/attempts")->json('id');
    $this->putJson("/api/attempts/{$id}", ['responses' => [$q1->id => 0, $q2->id => 0]]);
    $this->postJson("/api/attempts/{$id}/submit")->assertOk()->assertJsonPath('score', '2.00');

    $this->actingAs($teacher);
    $this->putJson("/api/tests/{$test->id}", [
        'title' => $test->title, 'subject' => 'math', 'grade_level' => 'k-2',
        'questions' => [
            ['id' => $q1->id, 'type' => 'multiple_choice', 'prompt' => 'changed', 'options' => ['a', 'b'], 'answer' => 1, 'points' => 10],
        ],
    ])->assertOk();

    $this->actingAs($student);
    $res = $this->getJson("/api/attempts/{$id}")->assertOk();
    expect($res->json('score'))->toBe('2.00')
        ->and($res->json('max_score'))->toBe('2.00')
        ->and($res->json('questions'))->toHaveCount(2)
        ->and($res->json('questions.0.graded_answer'))->toBe(['answer' => 0, 'points' => 1])
        ->and($res->json('questions.1.id'))->toBe($q2->id);
});
