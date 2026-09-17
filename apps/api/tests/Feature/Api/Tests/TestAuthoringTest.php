<?php

use App\Enums\Role;
use App\Models\Question;
use App\Models\Test;
use App\Models\User;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

function validTestBody(array $overrides = []): array
{
    return array_merge([
        'title' => 'Fractions warm-up',
        'description' => 'Ten minutes.',
        'subject' => 'math',
        'grade_level' => '3-5',
        'questions' => [
            ['type' => 'multiple_choice', 'prompt' => '1/2 + 1/4?', 'options' => ['1/4', '3/4', '1'], 'answer' => 1, 'points' => 2, 'explanation' => 'Common denominator.'],
            ['type' => 'true_false', 'prompt' => '1/2 > 1/3', 'answer' => true],
            ['type' => 'short_answer', 'prompt' => 'Name a unit fraction.', 'answer' => '1/2'],
            ['type' => 'numeric', 'prompt' => '0.5 as a fraction of 4?', 'answer' => ['value' => 2, 'tolerance' => 0]],
            ['type' => 'multi_select', 'prompt' => 'Which are > 1/2?', 'options' => ['1/3', '2/3', '3/4'], 'answer' => [1, 2], 'partial_credit' => true],
        ],
    ], $overrides);
}

test('a teacher creates a test with every question type and sees answers back', function () {
    $teacher = aTeacher();
    $this->actingAs($teacher);

    $res = $this->postJson('/api/tests', validTestBody())->assertCreated();

    $res->assertJsonPath('title', 'Fractions warm-up')
        ->assertJsonPath('visibility', 'private')
        ->assertJsonPath('question_count', 5)
        ->assertJsonPath('questions.0.answer', 1)
        ->assertJsonPath('questions.0.position', 0)
        ->assertJsonPath('questions.1.answer', true)
        ->assertJsonPath('questions.3.answer.value', 2)
        ->assertJsonPath('questions.4.partial_credit', true)
        ->assertJsonPath('author.id', $teacher->id);

    expect(Test::count())->toBe(1)->and(Question::count())->toBe(5);
});

test('only a teacher may create or list tests', function () {
    foreach (Role::cases() as $role) {
        if ($role === Role::Teacher) {
            continue;
        }
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        $this->postJson('/api/tests', validTestBody())->assertStatus(403);
        $this->getJson('/api/tests')->assertStatus(403);
        // The role gate must win even when the body is malformed: it must
        // never fall through to validation and answer 422 instead of 403.
        $this->postJson('/api/tests', ['title' => ''])->assertStatus(403);
    }
});

test('the index lists only the callers tests with counts', function () {
    $me = aTeacher();
    aTestWithQuestions($me, 3);
    aTestWithQuestions(aTeacher(), 1);
    $this->actingAs($me);

    $this->getJson('/api/tests')->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.question_count', 3)
        ->assertJsonPath('data.0.assignment_count', 0)
        ->assertJsonPath('meta.total', 1);
});

test('each question shape is rejected for every other type', function () {
    $this->actingAs(aTeacher());
    $shapes = validTestBody()['questions'];
    $types = ['multiple_choice', 'multi_select', 'true_false', 'short_answer', 'numeric'];

    foreach ($shapes as $shape) {
        foreach ($types as $type) {
            if ($type === $shape['type']) {
                continue;
            }
            $wrong = array_merge($shape, ['type' => $type]);
            $this->postJson('/api/tests', validTestBody(['questions' => [$wrong]]))
                ->assertStatus(422)
                ->assertJsonValidationErrors(['questions.0']);
        }
    }
});

test('authoring-time bounds are enforced', function () {
    $this->actingAs(aTeacher());
    $q = fn (array $o) => validTestBody(['questions' => [array_merge(['type' => 'multiple_choice', 'prompt' => 'p', 'options' => ['a', 'b'], 'answer' => 0], $o)]]);

    $this->postJson('/api/tests', $q(['answer' => 2]))->assertStatus(422);              // index out of range
    $this->postJson('/api/tests', $q(['options' => ['only']]))->assertStatus(422);       // < 2 options
    $this->postJson('/api/tests', $q(['options' => array_fill(0, 9, 'x')]))->assertStatus(422);
    $this->postJson('/api/tests', $q(['partial_credit' => true]))->assertStatus(422);    // not multi_select
    $this->postJson('/api/tests', $q(['points' => 0]))->assertStatus(422);
    $this->postJson('/api/tests', $q(['points' => 101]))->assertStatus(422);
    $this->postJson('/api/tests', validTestBody(['questions' => []]))->assertStatus(422);
    $this->postJson('/api/tests', validTestBody(['questions' => [
        ['type' => 'multi_select', 'prompt' => 'p', 'options' => ['a', 'b'], 'answer' => []],
    ]]))->assertStatus(422);
    $this->postJson('/api/tests', validTestBody(['questions' => [
        ['type' => 'numeric', 'prompt' => 'p', 'answer' => ['value' => 1, 'tolerance' => -1]],
    ]]))->assertStatus(422);
    $this->postJson('/api/tests', validTestBody(['questions' => [
        ['type' => 'true_false', 'prompt' => 'p', 'options' => ['a', 'b'], 'answer' => true],
    ]]))->assertStatus(422);
});

test('update keeps ids in place, creates new ones, and soft-deletes the rest', function () {
    $author = aTeacher();
    $test = aTestWithQuestions($author, 3);
    [$keep, $drop, $alsoDrop] = $test->questions->all();
    $this->actingAs($author);

    $this->putJson("/api/tests/{$test->id}", validTestBody(['title' => 'Renamed', 'questions' => [
        ['type' => 'true_false', 'prompt' => 'new first', 'answer' => false],
        ['id' => $keep->id, 'type' => 'multiple_choice', 'prompt' => 'edited', 'options' => ['x', 'y'], 'answer' => 1],
    ]]))->assertOk()
        ->assertJsonPath('title', 'Renamed')
        ->assertJsonPath('questions.0.prompt', 'new first')
        ->assertJsonPath('questions.0.position', 0)
        ->assertJsonPath('questions.1.id', $keep->id)
        ->assertJsonPath('questions.1.position', 1);

    expect($keep->fresh()->prompt)->toBe('edited')
        ->and(Question::withTrashed()->find($drop->id)->trashed())->toBeTrue()
        ->and(Question::withTrashed()->find($alsoDrop->id)->trashed())->toBeTrue()
        ->and($test->fresh()->questions)->toHaveCount(2);
});

test('an id from another test is ignored, not hijacked', function () {
    $author = aTeacher();
    $mine = aTestWithQuestions($author, 1);
    $theirs = aTestWithQuestions(aTeacher(), 1);
    $foreign = $theirs->questions->first();
    $this->actingAs($author);

    $this->putJson("/api/tests/{$mine->id}", validTestBody(['questions' => [
        ['id' => $foreign->id, 'type' => 'true_false', 'prompt' => 'stolen?', 'answer' => true],
    ]]))->assertOk();

    expect($foreign->fresh()->prompt)->not->toBe('stolen?')
        ->and($foreign->fresh()->test_id)->toBe($theirs->id);
});

test('a repeated id updates the first occurrence and creates a fresh row for the second', function () {
    $author = aTeacher();
    $test = aTestWithQuestions($author, 1);
    $original = $test->questions->first();
    $this->actingAs($author);

    $res = $this->putJson("/api/tests/{$test->id}", validTestBody(['questions' => [
        ['id' => $original->id, 'type' => 'true_false', 'prompt' => 'first', 'answer' => true],
        ['id' => $original->id, 'type' => 'true_false', 'prompt' => 'second', 'answer' => false],
    ]]))->assertOk();

    $res->assertJsonCount(2, 'questions')
        ->assertJsonPath('questions.0.id', $original->id)
        ->assertJsonPath('questions.0.prompt', 'first')
        ->assertJsonPath('questions.1.prompt', 'second');

    expect($res->json('questions.1.id'))->not->toBe($original->id)
        ->and($test->fresh()->questions)->toHaveCount(2)
        ->and($original->fresh()->prompt)->toBe('first');
});

test('a non-author gets 404 on update and delete of a private test', function () {
    $test = aTestWithQuestions(aTeacher());
    $this->actingAs(aTeacher());
    $this->putJson("/api/tests/{$test->id}", validTestBody())->assertStatus(404);
    $this->deleteJson("/api/tests/{$test->id}")->assertStatus(404);
    $this->deleteJson('/api/tests/999999')->assertStatus(404);
});

test('delete cascades questions', function () {
    $author = aTeacher();
    $test = aTestWithQuestions($author, 2);
    $this->actingAs($author);
    $this->deleteJson("/api/tests/{$test->id}")->assertNoContent();
    expect(Test::count())->toBe(0)->and(Question::withTrashed()->count())->toBe(0);
});
