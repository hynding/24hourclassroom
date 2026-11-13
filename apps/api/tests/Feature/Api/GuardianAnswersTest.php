<?php

use App\Enums\Role;
use App\Models\Assignment;
use App\Models\Connection;
use App\Models\User;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

/** A student's attempt on assigned work, submitted unless told otherwise; returns its id. */
function guardianAttempt(User $student, bool $submit = true, bool $assigned = true): int
{
    $teacher = aTeacher();
    $test = aTestWithQuestions($teacher, 2, ['title' => 'Cells quiz', 'visibility' => 'public', 'published_at' => now()]);
    if ($assigned) {
        connectAccepted($teacher, $student);
        Assignment::create(['test_id' => $test->id, 'student_id' => $student->id, 'teacher_id' => $teacher->id]);
    }
    test()->actingAs($student);
    $id = test()->postJson("/api/tests/{$test->id}/attempts")->json('id');
    if ($submit) {
        test()->postJson("/api/attempts/{$id}/submit")->assertOk();
    }

    return $id;
}

test('a connected guardian reads each question with the student\'s answer and the correct one', function () {
    $student = aStudent(['name' => 'Sam']);
    $id = guardianAttempt($student);
    $guardian = User::factory()->create(['role' => 'guardian']);
    connectAccepted($guardian, $student);
    $this->actingAs($guardian);

    $res = $this->getJson("/api/attempts/{$id}")->assertOk()
        ->assertJsonPath('student.name', 'Sam')
        ->assertJsonCount(2, 'questions');
    expect($res->json('questions.0'))->toHaveKeys(['response', 'answer', 'awarded']);

    // Read-only: no grading, no editing, no submitting.
    $answer = $res->json('questions.0.answer_id');
    $this->putJson("/api/attempts/{$id}/answers/{$answer}", ['awarded' => 1])->assertNotFound();
    $this->putJson("/api/attempts/{$id}", ['responses' => []])->assertNotFound();
});

test('only a role that sees connected students\' answers may open the attempt', function () {
    config(['app.debug' => false]);
    $student = aStudent();
    $id = guardianAttempt($student);

    foreach (Role::cases() as $role) {
        $viewer = User::factory()->create(['role' => $role->value]);
        // Direct, so the pair rules cannot hide the endpoint's own gate.
        connectAccepted($viewer, $student);
        $this->actingAs($viewer);

        expect($this->getJson("/api/attempts/{$id}")->status())
            ->toBe($role->seesConnectedStudentAnswers() ? 200 : 404, "role {$role->value}");
    }
});

test('an unsubmitted attempt, self-practice, a lost connection or an inactive student is a 404', function () {
    config(['app.debug' => false]);
    $student = aStudent();
    $open = guardianAttempt($student, submit: false);
    $practice = guardianAttempt($student, assigned: false);
    $submitted = guardianAttempt($student);
    $guardian = User::factory()->create(['role' => 'guardian']);
    $this->actingAs($guardian);

    // Not connected yet.
    $this->getJson("/api/attempts/{$submitted}")->assertNotFound();

    connectAccepted($guardian, $student);
    $this->getJson("/api/attempts/{$submitted}")->assertOk();
    $this->getJson("/api/attempts/{$open}")->assertNotFound();
    $this->getJson("/api/attempts/{$practice}")->assertNotFound();

    $student->forceFill(['deactivated_at' => now()])->save();
    $this->getJson("/api/attempts/{$submitted}")->assertNotFound();

    $student->forceFill(['deactivated_at' => null])->save();
    Connection::where('pair_key', Connection::pairKey($guardian->id, $student->id))->delete();
    $this->getJson("/api/attempts/{$submitted}")->assertNotFound();
});
