<?php

use App\Enums\Role;
use App\Models\Assignment;
use App\Models\Attempt;
use App\Models\User;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

function assignTo(User $teacher, User $student, string $title, ?string $due = null): Assignment
{
    connectAccepted($teacher, $student);
    $test = aTestWithQuestions($teacher, 2, ['title' => $title]);

    return Assignment::create(['test_id' => $test->id, 'student_id' => $student->id, 'teacher_id' => $teacher->id, 'due_at' => $due]);
}

test('a connected guardian sees every teacher\'s assignments with scores and no answers', function () {
    $student = aStudent(['name' => 'Sam']);
    $first = assignTo(aTeacher(['name' => 'Ms A']), $student, 'Cells quiz', '2026-11-01 12:00:00');
    assignTo(aTeacher(['name' => 'Mr B']), $student, 'Essay draft');

    Attempt::forceCreate([
        'test_id' => $first->test_id, 'assignment_id' => $first->id, 'student_id' => $student->id,
        'started_at' => now()->subHour(), 'submitted_at' => now(), 'score' => 1, 'max_score' => 2,
    ]);

    $guardian = User::factory()->create(['role' => 'guardian']);
    connectAccepted($guardian, $student);
    $this->actingAs($guardian);

    $res = $this->getJson("/api/students/{$student->id}/assignments")->assertOk()
        ->assertJsonPath('student', ['id' => $student->id, 'name' => 'Sam'])
        ->assertJsonCount(2, 'data')
        ->assertJsonPath('data.0.test.title', 'Cells quiz')
        ->assertJsonPath('data.0.test.author.name', 'Ms A')
        ->assertJsonPath('data.0.latest.score', '1.00')
        ->assertJsonPath('data.1.test.title', 'Essay draft')
        ->assertJsonPath('data.1.latest', null);

    expect($res->getContent())->not->toContain('"answer"')
        ->and($res->getContent())->not->toContain('"questions"');
});

test('every supporter role may read it; every other role 404s even when connected', function () {
    config(['app.debug' => false]);
    $student = aStudent();
    assignTo(aTeacher(), $student, 'Quiz');

    foreach (Role::cases() as $role) {
        $viewer = User::factory()->create(['role' => $role->value]);
        // Direct, so the pair rules cannot hide the endpoint's own gate.
        connectAccepted($viewer, $student);
        $this->actingAs($viewer);

        $status = $this->getJson("/api/students/{$student->id}/assignments")->status();
        expect($status)->toBe($role->supportsStudents() ? 200 : 404, "role {$role->value}");
    }
});

test('no accepted connection, an inactive student, or a non-student target is a 404', function () {
    config(['app.debug' => false]);
    $tutor = User::factory()->create(['role' => 'tutor']);
    $this->actingAs($tutor);

    $stranger = aStudent();
    $this->getJson("/api/students/{$stranger->id}/assignments")->assertNotFound();

    $pending = aStudent();
    App\Models\Connection::create([
        'requester_id' => $tutor->id, 'addressee_id' => $pending->id,
        'status' => App\Enums\ConnectionStatus::Pending,
        'pair_key' => App\Models\Connection::pairKey($tutor->id, $pending->id),
    ]);
    $this->getJson("/api/students/{$pending->id}/assignments")->assertNotFound();

    $gone = aStudent(['deactivated_at' => now()]);
    connectAccepted($tutor, $gone);
    $this->getJson("/api/students/{$gone->id}/assignments")->assertNotFound();

    $teacher = aTeacher();
    connectAccepted($tutor, $teacher);
    $this->getJson("/api/students/{$teacher->id}/assignments")->assertNotFound();

    $this->getJson('/api/students/999999/assignments')->assertNotFound();
});
