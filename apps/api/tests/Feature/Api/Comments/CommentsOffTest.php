<?php

use App\Models\Assignment;
use App\Models\Comment;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

function offThread(string $type, int $id): string
{
    return "/api/comments?target_type={$type}&target_id={$id}";
}

/** A private test assigned to two students, with a comment on the test and on its question. */
function assignedTestWithTalk(): array
{
    $teacher = aTeacher();
    $test = aTestWithQuestions($teacher, 1);
    [$a, $b] = [aStudent(), aStudent()];
    foreach ([$a, $b] as $student) {
        Assignment::create(['test_id' => $test->id, 'student_id' => $student->id, 'teacher_id' => $teacher->id]);
    }
    $question = $test->questions()->first();
    $onTest = Comment::create(['user_id' => $a->id, 'test_id' => $test->id, 'body' => 'Fun test']);
    $onQuestion = Comment::create(['user_id' => $a->id, 'question_id' => $question->id, 'body' => 'It is B']);

    return compact('teacher', 'test', 'a', 'b', 'question', 'onTest', 'onQuestion');
}

test('tests take comments by default, and only the author switches them', function () {
    ['teacher' => $teacher, 'test' => $test, 'a' => $a] = assignedTestWithTalk();
    expect($test->fresh()->comments_enabled)->toBeTrue();

    $this->actingAs($a)->putJson("/api/tests/{$test->id}/comments", ['enabled' => false])->assertNotFound();
    $this->actingAs(aTeacher())->putJson("/api/tests/{$test->id}/comments", ['enabled' => false])->assertNotFound();
    $this->actingAs($teacher)->putJson("/api/tests/{$test->id}/comments", ['enabled' => 'nope'])->assertUnprocessable();
    expect($test->fresh()->comments_enabled)->toBeTrue();

    $this->actingAs($teacher)->putJson("/api/tests/{$test->id}/comments", ['enabled' => false])
        ->assertOk()->assertJsonPath('comments_enabled', false);
    $this->getJson("/api/tests/{$test->id}")->assertJsonPath('comments_enabled', false);
});

test('turned off, the test and its questions take no comments and students see none of what was said', function () {
    ['teacher' => $teacher, 'test' => $test, 'a' => $a, 'b' => $b, 'question' => $question, 'onTest' => $onTest, 'onQuestion' => $onQuestion] = assignedTestWithTalk();
    $test->update(['comments_enabled' => false]);

    foreach ([$a, $b] as $student) {
        $this->actingAs($student);
        foreach ([['test', $test->id], ['question', $question->id]] as [$type, $id]) {
            $this->getJson(offThread($type, $id))->assertOk()
                ->assertJsonPath('data', [])
                ->assertJsonPath('closed', true)
                ->assertJsonPath('can_comment', false);
            $this->postJson('/api/comments', ['target_type' => $type, 'target_id' => $id, 'body' => 'Answer is C'])->assertForbidden();
        }
        // Not even the writer reaches their own comment while it is closed.
        $this->patchJson("/api/comments/{$onQuestion->id}", ['body' => 'edited'])->assertNotFound();
        $this->deleteJson("/api/comments/{$onTest->id}")->assertNotFound();
    }

    // The author still reads it, and can clear it out.
    $this->actingAs($teacher);
    $this->getJson(offThread('question', $question->id))->assertOk()
        ->assertJsonPath('data.0.body', 'It is B')
        ->assertJsonPath('can_comment', false)
        ->assertJsonPath('closed', true);
    $this->actingAs($teacher)->deleteJson("/api/comments/{$onQuestion->id}")->assertNoContent();
    $this->postJson('/api/comments', ['target_type' => 'test', 'target_id' => $test->id, 'body' => 'Closed now'])->assertForbidden();
});

test('turned back on, everything returns', function () {
    ['teacher' => $teacher, 'test' => $test, 'a' => $a, 'question' => $question] = assignedTestWithTalk();
    $this->actingAs($teacher)->putJson("/api/tests/{$test->id}/comments", ['enabled' => false])->assertOk();
    $this->actingAs($teacher)->putJson("/api/tests/{$test->id}/comments", ['enabled' => true])->assertOk();

    $this->actingAs($a);
    $this->getJson(offThread('question', $question->id))->assertJsonPath('data.0.body', 'It is B')->assertJsonPath('closed', false);
    $this->postJson('/api/comments', ['target_type' => 'question', 'target_id' => $question->id, 'body' => 'Thanks'])->assertCreated();
});

test('a copy keeps its source\'s setting; materials and courses have no switch', function () {
    $teacher = aTeacher();
    $test = aTestWithQuestions($teacher, 1, ['visibility' => 'public', 'published_at' => now(), 'comments_enabled' => false]);

    $copy = $this->actingAs(aTeacher())->postJson("/api/tests/{$test->id}/copy")->assertCreated();
    expect($copy->json('comments_enabled'))->toBeFalse();

    $course = aCourse($teacher, [$test], ['visibility' => 'public', 'published_at' => now()]);
    $this->getJson(offThread('course', $course->id))->assertJsonPath('closed', false);
});

test('an admin still reads a closed public test\'s discussion; others do not', function () {
    $teacher = aTeacher();
    $test = aTestWithQuestions($teacher, 1, ['visibility' => 'public', 'published_at' => now(), 'comments_enabled' => false]);
    Comment::create(['user_id' => aStudent()->id, 'test_id' => $test->id, 'body' => 'Old talk']);

    $this->actingAs(\App\Models\User::factory()->create(['role' => 'admin']));
    $this->getJson(offThread('test', $test->id))->assertJsonPath('data.0.body', 'Old talk');
    $this->actingAs(aTeacher());
    $this->getJson(offThread('test', $test->id))->assertJsonPath('data', [])->assertJsonPath('closed', true);
});
