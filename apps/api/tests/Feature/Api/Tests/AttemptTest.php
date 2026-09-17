<?php

use App\Enums\Role;
use App\Models\Assignment;
use App\Models\Attempt;
use App\Models\Question;
use App\Models\User;
use App\Notifications\AttemptSubmitted;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

function assignedSetup(): array
{
    $teacher = aTeacher();
    $test = aTestWithQuestions($teacher, 0);
    $mc = Question::factory()->for($test)->create(['position' => 0, 'points' => 2]);      // answer 0
    $sa = Question::factory()->for($test)->shortAnswer()->create(['position' => 1]);     // 1 point
    $student = aStudent();
    connectAccepted($teacher, $student);
    $assignment = Assignment::create(['test_id' => $test->id, 'student_id' => $student->id, 'teacher_id' => $teacher->id]);

    return compact('teacher', 'test', 'mc', 'sa', 'student', 'assignment');
}

test('starting returns the open attempt and links the assignment; answers are stripped until submit', function () {
    ['test' => $test, 'student' => $student, 'assignment' => $assignment, 'mc' => $mc, 'sa' => $sa] = assignedSetup();
    $this->actingAs($student);

    $first = $this->postJson("/api/tests/{$test->id}/attempts")->assertCreated();
    expect($first->json('assignment_id'))->toBe($assignment->id)
        ->and($first->json('questions.0'))->not->toHaveKey('answer')
        ->and($first->json('questions.0.response'))->toBeNull();

    $again = $this->postJson("/api/tests/{$test->id}/attempts")->assertOk();
    expect($again->json('id'))->toBe($first->json('id'))->and(Attempt::count())->toBe(1);

    $id = $first->json('id');
    $this->putJson("/api/attempts/{$id}", ['responses' => [$mc->id => 0, $sa->id => 'chlorophyll', 999 => 'ignored']])->assertOk()
        ->assertJsonPath('questions.0.response', 0)
        ->assertJsonPath('questions.1.response', 'chlorophyll');

    $submitted = $this->postJson("/api/attempts/{$id}/submit")->assertOk();
    expect((float) $submitted->json('score'))->toBe(2.0)
        ->and((float) $submitted->json('max_score'))->toBe(3.0)
        ->and($submitted->json('ungraded_count'))->toBe(1)
        ->and($submitted->json('graded_at'))->toBeNull()
        ->and($submitted->json('questions.0.answer'))->toBe(0)
        ->and((float) $submitted->json('questions.0.awarded'))->toBe(2.0)
        ->and($submitted->json('questions.1.awarded'))->toBeNull()
        ->and($submitted->json('questions.1.answer_id'))->not->toBeNull();

    $this->putJson("/api/attempts/{$id}", ['responses' => []])->assertStatus(409);
    $this->postJson("/api/attempts/{$id}/submit")->assertStatus(409);
});

test('submit is guarded by a conditional update, not a stale read', function () {
    ['test' => $test, 'student' => $student] = assignedSetup();
    $this->actingAs($student);
    $id = $this->postJson("/api/tests/{$test->id}/attempts")->json('id');
    Attempt::whereKey($id)->update(['submitted_at' => now()]);

    $this->postJson("/api/attempts/{$id}/submit")->assertStatus(409);
    expect(Attempt::find($id)->answers()->count())->toBe(0);
});

test('a self-practice attempt on a public test has no assignment and is invisible to the author', function () {
    $author = aTeacher();
    $test = aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()]);
    $student = aStudent();
    $this->actingAs($student);

    $id = $this->postJson("/api/tests/{$test->id}/attempts")->assertCreated()->assertJsonPath('assignment_id', null)->json('id');
    $this->postJson("/api/attempts/{$id}/submit")->assertOk();

    $this->actingAs($author);
    $this->getJson("/api/attempts/{$id}")->assertStatus(404);
    expect($author->notifications()->count())->toBe(0);

    // Unpublishing later does not take the attempt away from the student.
    $test->update(['visibility' => 'private']);
    $this->actingAs($student);
    $this->getJson("/api/attempts/{$id}")->assertOk();
    $this->postJson("/api/tests/{$test->id}/attempts")->assertStatus(404);
});

test('only students start attempts; a private unassigned test is 404', function () {
    $test = aTestWithQuestions(aTeacher(), 1, ['visibility' => 'public', 'published_at' => now()]);
    foreach (Role::cases() as $role) {
        if ($role === Role::Student) {
            continue;
        }
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        $this->postJson("/api/tests/{$test->id}/attempts")->assertStatus(403);
    }
    $private = aTestWithQuestions(aTeacher(), 1);
    $this->actingAs(aStudent());
    $this->postJson("/api/tests/{$private->id}/attempts")->assertStatus(404);
});

test('the assigning teacher sees an assigned attempt while connected and is notified on submit', function () {
    ['test' => $test, 'student' => $student, 'teacher' => $teacher] = assignedSetup();
    $this->actingAs($student);
    $id = $this->postJson("/api/tests/{$test->id}/attempts")->json('id');
    $this->postJson("/api/attempts/{$id}/submit")->assertOk();

    expect($teacher->notifications()->count())->toBe(1)
        ->and($teacher->notifications()->first()->type)->toBe(AttemptSubmitted::class)
        ->and($teacher->notifications()->first()->data['ungraded_count'])->toBe(1)
        ->and($teacher->notifications()->first()->data['user']['id'])->toBe($student->id);

    $this->actingAs($teacher);
    $this->getJson("/api/attempts/{$id}")->assertOk()->assertJsonPath('student.id', $student->id);

    \App\Models\Connection::query()->delete();
    $this->getJson("/api/attempts/{$id}")->assertStatus(404);

    $this->actingAs(aTeacher());
    $this->getJson("/api/attempts/{$id}")->assertStatus(404);
});

test('no notification when the connection is gone at submit time', function () {
    ['test' => $test, 'student' => $student, 'teacher' => $teacher] = assignedSetup();
    $this->actingAs($student);
    $id = $this->postJson("/api/tests/{$test->id}/attempts")->json('id');
    \App\Models\Connection::query()->delete();
    $this->postJson("/api/attempts/{$id}/submit")->assertOk();
    expect($teacher->notifications()->count())->toBe(0);
});

test('a student lists all their attempts including self-practice', function () {
    ['test' => $assigned, 'student' => $student] = assignedSetup();
    $public = aTestWithQuestions(aTeacher(), 1, ['visibility' => 'public', 'published_at' => now()]);
    $this->actingAs($student);
    $this->postJson("/api/tests/{$assigned->id}/attempts");
    $this->postJson("/api/tests/{$public->id}/attempts");

    $this->getJson('/api/attempts')->assertOk()->assertJsonCount(2, 'data')
        ->assertJsonPath('data.0.test.id', $public->id)
        ->assertJsonPath('data.0.assignment_id', null);

    foreach (Role::cases() as $role) {
        if ($role === Role::Student) {
            continue;
        }
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        $this->getJson('/api/attempts')->assertStatus(403);
    }
});
