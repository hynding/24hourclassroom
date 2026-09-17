<?php

use App\Enums\Role;
use App\Models\Assignment;
use App\Models\User;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('a private test is 404 for everyone but author and assigned, byte-identical to a missing id', function () {
    $author = aTeacher();
    $test = aTestWithQuestions($author);
    $missing = $this->getJson('/api/tests/999999')->assertStatus(404)->getContent();

    $this->getJson("/api/tests/{$test->id}")->assertStatus(404);
    expect($this->getJson("/api/tests/{$test->id}")->getContent())->toBe($missing);

    foreach (Role::cases() as $role) {
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        expect($this->getJson("/api/tests/{$test->id}")->assertStatus(404)->getContent())->toBe($missing);
    }

    $this->actingAs($author);
    $this->getJson("/api/tests/{$test->id}")->assertOk()->assertJsonPath('is_author', true)->assertJsonPath('questions.0.answer', 0);

    $student = aStudent();
    Assignment::create(['test_id' => $test->id, 'student_id' => $student->id, 'teacher_id' => $author->id, 'due_at' => now()->addDay()]);
    $this->actingAs($student);
    $res = $this->getJson("/api/tests/{$test->id}")->assertOk()->assertJsonPath('is_author', false)->assertJsonPath('can_copy', false);
    expect($res->json('assignment.id'))->not->toBeNull()
        ->and($res->json('questions.0'))->not->toHaveKey('answer')
        ->and($res->json('questions.0'))->not->toHaveKey('explanation');
});

test('a public test is readable logged out, answers stripped, can_copy only for other teachers', function () {
    $author = aTeacher();
    $test = aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()]);

    $res = $this->getJson("/api/tests/{$test->id}")->assertOk();
    expect($res->json('questions.0'))->not->toHaveKey('answer')
        ->and($res->json('can_copy'))->toBeFalse();

    foreach (Role::cases() as $role) {
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        $this->getJson("/api/tests/{$test->id}")->assertOk()->assertJsonPath('can_copy', $role === Role::Teacher);
    }

    $this->actingAs($author);
    $this->getJson("/api/tests/{$test->id}")->assertOk()->assertJsonPath('can_copy', false)->assertJsonPath('questions.0.answer', 0);
});

test('a deactivated author hides the public path but not the assigned path', function () {
    $author = aTeacher();
    $test = aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()]);
    $student = aStudent();
    Assignment::create(['test_id' => $test->id, 'student_id' => $student->id, 'teacher_id' => $author->id]);
    $author->forceFill(['deactivated_at' => now()])->save();

    $this->getJson("/api/tests/{$test->id}")->assertStatus(404);
    $this->actingAs(aTeacher());
    $this->getJson("/api/tests/{$test->id}")->assertStatus(404);
    $this->actingAs($student);
    $this->getJson("/api/tests/{$test->id}")->assertOk();
});
