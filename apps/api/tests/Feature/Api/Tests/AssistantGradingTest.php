<?php

use App\Enums\Role;
use App\Models\Answer;
use App\Models\Assignment;
use App\Models\Attempt;
use App\Models\Connection;
use App\Models\Question;
use App\Models\User;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

/** A teacher, a connected student with a submitted attempt, and the short-answer row to grade. */
function assistantGradingSetup(): array
{
    $teacher = aTeacher(['name' => 'Ms A']);
    $test = aTestWithQuestions($teacher, 0, ['title' => 'Cells quiz']);
    Question::factory()->for($test)->shortAnswer()->create(['position' => 0, 'points' => 5]);
    $student = aStudent(['name' => 'Sam']);
    connectAccepted($teacher, $student);
    Assignment::create(['test_id' => $test->id, 'student_id' => $student->id, 'teacher_id' => $teacher->id]);

    test()->actingAs($student);
    $id = test()->postJson("/api/tests/{$test->id}/attempts")->json('id');
    test()->postJson("/api/attempts/{$id}/submit")->assertOk();
    $attempt = Attempt::find($id);
    $row = Answer::where('attempt_id', $id)->first();

    return compact('teacher', 'test', 'student', 'attempt', 'row');
}

test('an assistant connected to the teacher reads and grades the attempt, recorded as theirs', function () {
    ['teacher' => $teacher, 'attempt' => $attempt, 'row' => $row] = assistantGradingSetup();
    $assistant = User::factory()->create(['role' => 'assistant']);
    connectAccepted($assistant, $teacher);
    $this->actingAs($assistant);

    $this->getJson("/api/attempts/{$attempt->id}")->assertOk()->assertJsonPath('student.name', 'Sam');
    $this->putJson("/api/attempts/{$attempt->id}/answers/{$row->id}", ['awarded' => 4])
        ->assertOk()
        ->assertJsonPath('score', '4.00')
        ->assertJsonPath('ungraded_count', 0);

    expect($row->fresh()->graded_by)->toBe($assistant->id);
});

test('only an assistant role grades for a connected teacher; every other role 404s even when connected', function () {
    config(['app.debug' => false]);
    ['teacher' => $teacher, 'attempt' => $attempt, 'row' => $row] = assistantGradingSetup();

    foreach (Role::cases() as $role) {
        $viewer = User::factory()->create(['role' => $role->value]);
        // Direct, so the pair rules cannot hide the endpoint's own gate.
        connectAccepted($viewer, $teacher);
        $this->actingAs($viewer);

        $expected = $role->gradesForConnectedTeachers() ? 200 : 404;
        expect($this->getJson("/api/attempts/{$attempt->id}")->status())->toBe($expected, "view as {$role->value}")
            ->and($this->putJson("/api/attempts/{$attempt->id}/answers/{$row->id}", ['awarded' => 1])->status())->toBe($expected, "grade as {$role->value}");
    }
});

test('an assistant needs a live connection to the teacher, and the teacher one to the student', function () {
    config(['app.debug' => false]);
    ['teacher' => $teacher, 'student' => $student, 'attempt' => $attempt, 'row' => $row] = assistantGradingSetup();
    $assistant = User::factory()->create(['role' => 'assistant']);
    $this->actingAs($assistant);

    // Connected to the student only: not enough.
    connectAccepted($assistant, $student);
    $this->putJson("/api/attempts/{$attempt->id}/answers/{$row->id}", ['awarded' => 1])->assertNotFound();
    $this->getJson('/api/grading')->assertOk()->assertJsonCount(0, 'data');

    connectAccepted($assistant, $teacher);
    $this->getJson('/api/grading')->assertOk()->assertJsonCount(1, 'data');

    // The teacher drops the student: the assistant loses the attempt too.
    Connection::where('pair_key', Connection::pairKey($teacher->id, $student->id))->delete();
    $this->putJson("/api/attempts/{$attempt->id}/answers/{$row->id}", ['awarded' => 1])->assertNotFound();
    $this->getJson('/api/grading')->assertOk()->assertJsonCount(0, 'data');
});

test('a deactivated teacher\'s assignments are closed to their assistant', function () {
    config(['app.debug' => false]);
    ['teacher' => $teacher, 'attempt' => $attempt, 'row' => $row] = assistantGradingSetup();
    $assistant = User::factory()->create(['role' => 'assistant']);
    connectAccepted($assistant, $teacher);
    $teacher->forceFill(['deactivated_at' => now()])->save();
    $this->actingAs($assistant);

    $this->putJson("/api/attempts/{$attempt->id}/answers/{$row->id}", ['awarded' => 1])->assertNotFound();
    $this->getJson('/api/grading')->assertOk()->assertJsonCount(0, 'data');
});

test('the grading queue lists what still needs a hand grade, for the teacher and their assistant alike', function () {
    ['teacher' => $teacher, 'attempt' => $attempt, 'row' => $row] = assistantGradingSetup();
    $assistant = User::factory()->create(['role' => 'assistant']);
    connectAccepted($assistant, $teacher);

    // Another teacher's attempt the assistant is not connected to.
    assistantGradingSetup();

    foreach ([$teacher, $assistant] as $viewer) {
        $this->actingAs($viewer);
        $this->getJson('/api/grading')->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id', $attempt->id)
            ->assertJsonPath('data.0.student.name', 'Sam')
            ->assertJsonPath('data.0.test.title', 'Cells quiz')
            ->assertJsonPath('data.0.teacher.name', 'Ms A')
            ->assertJsonPath('data.0.ungraded_count', 1);
    }

    $this->putJson("/api/attempts/{$attempt->id}/answers/{$row->id}", ['awarded' => 2])->assertOk();
    $this->getJson('/api/grading')->assertOk()->assertJsonCount(0, 'data');

    // Roles with nothing to grade get an empty page, not an error.
    $this->actingAs(aStudent());
    $this->getJson('/api/grading')->assertOk()->assertJsonCount(0, 'data');
});
