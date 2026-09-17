<?php

use App\Enums\Role;
use App\Models\Assignment;
use App\Models\Attempt;
use App\Models\User;
use App\Notifications\TestAssigned;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('assigning reports per id and only connected active students get assigned', function () {
    $teacher = aTeacher();
    $test = aTestWithQuestions($teacher, 1);
    $ok = aStudent();
    connectAccepted($teacher, $ok);
    $pending = aStudent();
    \App\Models\Connection::create(['requester_id' => $teacher->id, 'addressee_id' => $pending->id, 'status' => 'pending', 'pair_key' => \App\Models\Connection::pairKey($teacher->id, $pending->id)]);
    $stranger = aStudent();
    $deactivated = aStudent();
    connectAccepted($teacher, $deactivated);
    $deactivated->forceFill(['deactivated_at' => now()])->save();
    $otherTeacher = aTeacher();
    connectAccepted($teacher, $otherTeacher);
    $this->actingAs($teacher);

    $ids = [$ok->id, $pending->id, $stranger->id, $deactivated->id, $otherTeacher->id, 999999];
    $res = $this->postJson("/api/tests/{$test->id}/assignments", ['student_ids' => $ids, 'due_at' => now()->addWeek()->toISOString()])->assertOk();

    expect($res->json('results'))->toBe([
        ['id' => $ok->id, 'status' => 'assigned'],
        ['id' => $pending->id, 'status' => 'not_found'],
        ['id' => $stranger->id, 'status' => 'not_found'],
        ['id' => $deactivated->id, 'status' => 'not_found'],
        ['id' => $otherTeacher->id, 'status' => 'not_found'],
        ['id' => 999999, 'status' => 'not_found'],
    ]);
    $firstAssignmentId = Assignment::first()->id;
    expect(Assignment::count())->toBe(1)
        ->and($ok->notifications()->count())->toBe(1)
        ->and($ok->notifications()->first()->type)->toBe(TestAssigned::class)
        ->and($ok->notifications()->first()->data['test_title'])->toBe($test->title)
        ->and($ok->notifications()->first()->data['user']['id'])->toBe($teacher->id)
        ->and($ok->notifications()->first()->data['test_id'])->toBe($test->id)
        ->and($ok->notifications()->first()->data['assignment_id'])->toBe($firstAssignmentId)
        ->and($ok->notifications()->first()->data['due_at'])->not->toBeNull();

    // Idempotent: a second assign of the same student is 'assigned' and sends nothing new.
    $this->postJson("/api/tests/{$test->id}/assignments", ['student_ids' => [$ok->id]])->assertOk()
        ->assertJsonPath('results.0.status', 'assigned');
    expect(Assignment::count())->toBe(1)->and($ok->notifications()->count())->toBe(1);

    // A re-POST that carries a NEW due_at updates the existing assignment,
    // still with no new row and no new notification.
    $newDue = now()->addWeeks(2);
    $this->postJson("/api/tests/{$test->id}/assignments", ['student_ids' => [$ok->id], 'due_at' => $newDue->toISOString()])
        ->assertOk()->assertJsonPath('results.0.status', 'assigned');
    expect(Assignment::count())->toBe(1)
        ->and($ok->notifications()->count())->toBe(1)
        ->and(Assignment::first()->due_at->toDateTimeString())->toBe($newDue->toDateTimeString());

    // A re-POST that omits due_at entirely leaves the due date untouched.
    $this->postJson("/api/tests/{$test->id}/assignments", ['student_ids' => [$ok->id]])->assertOk();
    expect(Assignment::first()->due_at->toDateTimeString())->toBe($newDue->toDateTimeString());
});

test('a test with no questions cannot be assigned', function () {
    $teacher = aTeacher();
    $empty = aTestWithQuestions($teacher, 0);
    $student = aStudent();
    connectAccepted($teacher, $student);
    $this->actingAs($teacher);
    $this->postJson("/api/tests/{$empty->id}/assignments", ['student_ids' => [$student->id]])->assertStatus(422);
});

test('only the author manages assignments; non-authors 404 on private', function () {
    $test = aTestWithQuestions(aTeacher(), 1);
    foreach (Role::cases() as $role) {
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        $this->getJson("/api/tests/{$test->id}/assignments")->assertStatus(404);
        $this->postJson("/api/tests/{$test->id}/assignments", ['student_ids' => [1]])->assertStatus(404);
    }
});

test('the author sees assignments with latest and best, excluding disconnected students', function () {
    $teacher = aTeacher();
    $test = aTestWithQuestions($teacher, 1);
    $question = $test->questions()->first();
    $a = aStudent();
    $b = aStudent();
    $ca = connectAccepted($teacher, $a);
    connectAccepted($teacher, $b);
    $aa = Assignment::create(['test_id' => $test->id, 'student_id' => $a->id, 'teacher_id' => $teacher->id]);
    Assignment::create(['test_id' => $test->id, 'student_id' => $b->id, 'teacher_id' => $teacher->id]);

    $best = Attempt::create(['test_id' => $test->id, 'student_id' => $a->id, 'assignment_id' => $aa->id, 'started_at' => now()->subHour()]);
    $best->forceFill(['submitted_at' => now()->subHour(), 'score' => 5, 'max_score' => 10, 'graded_at' => now()])->save();

    $latest = Attempt::create(['test_id' => $test->id, 'student_id' => $a->id, 'assignment_id' => $aa->id, 'started_at' => now()]);
    $latest->forceFill(['submitted_at' => now(), 'score' => 3, 'max_score' => 10, 'graded_at' => now()])->save();
    // A stray ungraded answer row on the latest attempt, added after grading.
    $latest->answers()->create(['question_id' => $question->id, 'response' => null]);

    // Open (unsubmitted), created AFTER both submitted attempts: must not
    // become "latest" -- only submitted attempts count for latest/best.
    Attempt::create(['test_id' => $test->id, 'student_id' => $a->id, 'assignment_id' => $aa->id, 'started_at' => now()->addMinute()]);

    $this->actingAs($teacher);

    $res = $this->getJson("/api/tests/{$test->id}/assignments")->assertOk()->assertJsonCount(2, 'data');
    $rowA = collect($res->json('data'))->firstWhere('student.id', $a->id);
    expect($rowA['latest']['id'])->toBe($latest->id)
        ->and((float) $rowA['latest']['score'])->toBe(3.0)
        ->and($rowA['latest']['ungraded_count'])->toBe(1)
        ->and($rowA['best']['id'])->toBe($best->id)
        ->and((float) $rowA['best']['score'])->toBe(5.0);

    $ca->delete();
    $this->getJson("/api/tests/{$test->id}/assignments")->assertOk()->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.student.id', $b->id);
});

test('unassigning keeps the attempt but nulls its assignment', function () {
    $teacher = aTeacher();
    $test = aTestWithQuestions($teacher, 1);
    $s = aStudent();
    connectAccepted($teacher, $s);
    $as = Assignment::create(['test_id' => $test->id, 'student_id' => $s->id, 'teacher_id' => $teacher->id]);
    $attempt = Attempt::create(['test_id' => $test->id, 'student_id' => $s->id, 'assignment_id' => $as->id, 'started_at' => now()]);
    $this->actingAs($teacher);

    $this->deleteJson("/api/tests/{$test->id}/assignments/{$as->id}")->assertNoContent();
    expect($attempt->fresh()->assignment_id)->toBeNull();

    // An assignment id from another test is 404.
    $other = aTestWithQuestions($teacher, 1);
    $foreign = Assignment::create(['test_id' => $other->id, 'student_id' => $s->id, 'teacher_id' => $teacher->id]);
    $this->deleteJson("/api/tests/{$test->id}/assignments/{$foreign->id}")->assertStatus(404);
});

test('a student lists their own assignments with test summary and attempt stats', function () {
    $teacher = aTeacher();
    $test = aTestWithQuestions($teacher, 2);
    $me = aStudent();
    $as = Assignment::create(['test_id' => $test->id, 'student_id' => $me->id, 'teacher_id' => $teacher->id, 'due_at' => now()->addDay()]);
    Assignment::create(['test_id' => $test->id, 'student_id' => aStudent()->id, 'teacher_id' => $teacher->id]);
    $this->actingAs($me);

    $this->getJson('/api/assignments')->assertOk()->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.id', $as->id)
        ->assertJsonPath('data.0.test.id', $test->id)
        ->assertJsonPath('data.0.test.question_count', 2)
        ->assertJsonPath('data.0.latest', null)
        ->assertJsonPath('data.0.best', null);

    foreach (Role::cases() as $role) {
        if ($role === Role::Student) {
            continue;
        }
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        $this->getJson('/api/assignments')->assertStatus(403);
    }
});
