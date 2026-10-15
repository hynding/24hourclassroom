<?php

use App\Enums\Role;
use App\Models\Assignment;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Material;
use App\Models\Test;
use App\Models\User;
use App\Notifications\CommentPosted;
use Illuminate\Support\Facades\Notification;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

function commentOn(User $author, string $type, int $id, string $body = 'Hello', ?Comment $parent = null): Comment
{
    return Comment::create([
        'user_id' => $author->id,
        'parent_id' => $parent?->id,
        "{$type}_id" => $id,
        'body' => $body,
    ]);
}

function threadQuery(string $type, int $id): string
{
    return "/api/comments?target_type={$type}&target_id={$id}";
}

test('anyone who can see a public test discusses it, its questions, materials and courses', function () {
    $author = aTeacher(['name' => 'Ms K']);
    $test = aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()]);
    $question = $test->questions()->first();
    $material = Material::factory()->for($author, 'author')->published()->create();
    $course = aCourse($author, [$test], ['visibility' => 'public', 'published_at' => now()]);
    $this->actingAs($other = aTeacher(['name' => 'Mr T']));

    foreach (['test' => $test->id, 'question' => $question->id, 'material' => $material->id, 'course' => $course->id] as $type => $id) {
        $this->postJson('/api/comments', ['target_type' => $type, 'target_id' => $id, 'body' => "On the {$type}"])
            ->assertCreated()
            ->assertJsonPath('body', "On the {$type}")
            ->assertJsonPath('author.name', 'Mr T')
            ->assertJsonPath('is_mine', true)
            ->assertJsonPath('can_edit', true)
            ->assertJsonPath('can_delete', true)
            ->assertJsonPath('replies', []);

        $this->getJson(threadQuery($type, $id))->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.body', "On the {$type}")
            ->assertJsonPath('can_comment', true)
            ->assertJsonPath('can_moderate', false);
    }

    // Each target keeps its own discussion.
    expect(Comment::where('test_id', $test->id)->count())->toBe(1)
        ->and(Comment::where('question_id', $question->id)->count())->toBe(1);
});

test('a hidden target and a missing one are both 404, for reading and writing', function () {
    $author = aTeacher();
    $private = aTestWithQuestions($author, 1);
    $this->actingAs(aTeacher());

    $this->getJson(threadQuery('test', $private->id))->assertNotFound();
    $this->getJson(threadQuery('question', $private->questions()->first()->id))->assertNotFound();
    $this->getJson(threadQuery('test', 999999))->assertNotFound();
    $this->postJson('/api/comments', ['target_type' => 'test', 'target_id' => $private->id, 'body' => 'x'])->assertNotFound();
    $this->getJson(threadQuery('lesson', 1))->assertUnprocessable()->assertJsonValidationErrors('target_type');
});

test('signed-in only: a guest cannot read a discussion even on a public test', function () {
    $test = Test::factory()->published()->create();

    $this->getJson(threadQuery('test', $test->id))->assertUnauthorized();
});

test('an assigned student discusses a private test and its questions with the teacher', function () {
    $teacher = aTeacher(['name' => 'Ms K']);
    $student = aStudent(['name' => 'Sam']);
    $test = aTestWithQuestions($teacher, 1);
    Assignment::create(['test_id' => $test->id, 'student_id' => $student->id, 'teacher_id' => $teacher->id]);
    connectAccepted($teacher, $student);
    $question = $test->questions()->first();

    $this->actingAs($student);
    $this->postJson('/api/comments', ['target_type' => 'question', 'target_id' => $question->id, 'body' => 'Is it B?'])->assertCreated();

    $this->actingAs($teacher);
    $this->getJson(threadQuery('question', $question->id))->assertOk()
        ->assertJsonPath('data.0.author.name', 'Sam')
        ->assertJsonPath('data.0.can_edit', false)
        ->assertJsonPath('data.0.can_delete', true)
        ->assertJsonPath('can_moderate', true);
});

test('a student\'s name reaches only themselves, their connections and administrators', function () {
    $author = aTeacher();
    $test = Test::factory()->for($author, 'author')->published()->create();
    $student = aStudent(['name' => 'Sam']);
    commentOn($student, 'test', $test->id, 'From a student');
    commentOn($author, 'test', $test->id, 'From the teacher');

    // A stranger (the author included: they are not connected) sees the role only.
    $this->actingAs($author);
    $stranger = $this->getJson(threadQuery('test', $test->id))->assertOk();
    expect($stranger->json('data.0.author'))->toBe(['id' => null, 'name' => null, 'role' => 'student', 'avatar_url' => null])
        ->and($stranger->json('data.1.author.name'))->toBe($author->name);

    $this->actingAs($student);
    $this->getJson(threadQuery('test', $test->id))->assertJsonPath('data.0.author.name', 'Sam');

    $connected = aTeacher();
    connectAccepted($connected, $student);
    $this->actingAs($connected);
    $this->getJson(threadQuery('test', $test->id))->assertJsonPath('data.0.author.name', 'Sam');

    $admin = User::factory()->create(['role' => 'admin']);
    $this->actingAs($admin);
    $this->getJson(threadQuery('test', $test->id))
        ->assertJsonPath('data.0.author.name', 'Sam')
        ->assertJsonPath('can_comment', false)
        ->assertJsonPath('can_moderate', true)
        ->assertJsonPath('data.0.can_delete', true);
});

test('only roles that take part may post: every case of Role is checked', function () {
    $test = Test::factory()->published()->create();

    foreach (Role::cases() as $role) {
        $user = User::factory()->create(['role' => $role->value]);
        $this->actingAs($user);
        $res = $this->postJson('/api/comments', ['target_type' => 'test', 'target_id' => $test->id, 'body' => 'Hi']);
        $role->comments() ? $res->assertCreated() : $res->assertForbidden();
    }

    expect(Role::Admin->comments())->toBeFalse()
        ->and(Role::Admin->moderatesComments())->toBeTrue();
});

test('replies are one level deep: answering a reply joins its thread', function () {
    $test = Test::factory()->published()->create();
    $this->actingAs($me = aTeacher());

    $top = $this->postJson('/api/comments', ['target_type' => 'test', 'target_id' => $test->id, 'body' => 'Top'])->json('id');
    $reply = $this->postJson('/api/comments', ['target_type' => 'test', 'target_id' => $test->id, 'body' => 'Reply', 'parent_id' => $top])
        ->assertCreated()->assertJsonPath('parent_id', $top)->json('id');
    $this->postJson('/api/comments', ['target_type' => 'test', 'target_id' => $test->id, 'body' => 'Deeper', 'parent_id' => $reply])
        ->assertCreated()->assertJsonPath('parent_id', $top);

    $this->getJson(threadQuery('test', $test->id))->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.replies.0.body', 'Reply')
        ->assertJsonPath('data.0.replies.1.body', 'Deeper');

    // A parent on another target is refused.
    $other = Test::factory()->published()->create();
    $this->postJson('/api/comments', ['target_type' => 'test', 'target_id' => $other->id, 'body' => 'x', 'parent_id' => $top])
        ->assertUnprocessable()->assertJsonValidationErrors('parent_id');
});

test('the writer edits; the writer, the target\'s author and an admin delete', function () {
    $author = aTeacher();
    $test = Test::factory()->for($author, 'author')->published()->create();
    $writer = aTeacher();
    $comment = commentOn($writer, 'test', $test->id, 'Original');
    commentOn(aTeacher(), 'test', $test->id, 'A reply', $comment);

    $this->actingAs($author);
    $this->patchJson("/api/comments/{$comment->id}", ['body' => 'Hijack'])->assertForbidden();

    $bystander = aTeacher();
    $this->actingAs($bystander);
    $this->deleteJson("/api/comments/{$comment->id}")->assertForbidden();

    $this->actingAs($writer);
    $this->patchJson("/api/comments/{$comment->id}", ['body' => 'Fixed'])->assertOk()
        ->assertJsonPath('body', 'Fixed')
        ->assertJsonPath('replies.0.body', 'A reply');
    expect($comment->fresh()->edited_at)->not->toBeNull();

    // The target's author moderates their own test; the replies go too.
    $this->actingAs($author);
    $this->deleteJson("/api/comments/{$comment->id}")->assertNoContent();
    expect(Comment::count())->toBe(0);

    $again = commentOn($writer, 'test', $test->id);
    $this->actingAs(User::factory()->create(['role' => 'admin']));
    $this->deleteJson("/api/comments/{$again->id}")->assertNoContent();
});

test('a comment on something the caller cannot see is a 404, never a 403', function () {
    $author = aTeacher();
    $test = aTestWithQuestions($author, 1);
    $comment = commentOn($author, 'test', $test->id);

    $this->actingAs(aTeacher());
    $this->patchJson("/api/comments/{$comment->id}", ['body' => 'x'])->assertNotFound();
    $this->deleteJson("/api/comments/{$comment->id}")->assertNotFound();
    $this->deleteJson('/api/comments/999999')->assertNotFound();
});

test('deactivated people\'s comments are hidden, not deleted', function () {
    $test = Test::factory()->published()->create();
    $gone = aTeacher();
    $comment = commentOn($gone, 'test', $test->id, 'Hidden');
    commentOn(aTeacher(), 'test', $test->id, 'Shown');
    $gone->forceFill(['deactivated_at' => now()])->save();

    $this->actingAs(aTeacher());
    $this->getJson(threadQuery('test', $test->id))->assertOk()
        ->assertJsonCount(1, 'data')->assertJsonPath('data.0.body', 'Shown');
    $this->deleteJson("/api/comments/{$comment->id}")->assertNotFound();
    expect(Comment::whereKey($comment->id)->exists())->toBeTrue();
});

test('deleting the target deletes its discussion', function () {
    $author = aTeacher();
    $test = aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()]);
    $course = aCourse($author, [$test], ['visibility' => 'public', 'published_at' => now()]);
    commentOn($author, 'test', $test->id);
    commentOn($author, 'question', $test->questions()->first()->id);
    commentOn($author, 'course', $course->id);

    $course->delete();
    expect(Comment::count())->toBe(2);
    $test->delete();
    expect(Comment::count())->toBe(0);
});

test('a trashed question\'s discussion is gone with it', function () {
    $test = aTestWithQuestions(aTeacher(), 1, ['visibility' => 'public', 'published_at' => now()]);
    $question = $test->questions()->first();
    commentOn($test->author, 'question', $question->id);
    $question->delete();

    $this->actingAs(aTeacher());
    $this->getJson(threadQuery('question', $question->id))->assertNotFound();
});

test('the body is required and capped', function () {
    $test = Test::factory()->published()->create();
    $this->actingAs(aTeacher());

    $this->postJson('/api/comments', ['target_type' => 'test', 'target_id' => $test->id, 'body' => ''])
        ->assertUnprocessable()->assertJsonValidationErrors('body');
    $this->postJson('/api/comments', ['target_type' => 'test', 'target_id' => $test->id, 'body' => str_repeat('a', 2001)])
        ->assertUnprocessable()->assertJsonValidationErrors('body');
});

test('the target\'s author hears of a comment, and a writer of a reply, never the commenter', function () {
    Notification::fake();
    $author = aTeacher();
    $test = aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()]);
    $question = $test->questions()->first();
    $student = aStudent(['name' => 'Sam']);
    $first = commentOn($student, 'question', $question->id, 'Why B?');

    $this->actingAs($author);
    $this->postJson('/api/comments', ['target_type' => 'question', 'target_id' => $question->id, 'body' => 'Because', 'parent_id' => $first->id])->assertCreated();
    Notification::assertSentTo($student, CommentPosted::class, function (CommentPosted $n, array $channels, User $to) use ($author, $test, $question) {
        $data = $n->toArray($to);

        return $data['is_reply'] === true
            && $data['target_type'] === 'question'
            && $data['target_id'] === $question->id
            && $data['test_id'] === $test->id
            && $data['target_title'] === $test->title
            && $data['user']['name'] === $author->name;
    });
    Notification::assertNotSentTo($author, CommentPosted::class);

    $this->actingAs($student);
    $this->postJson('/api/comments', ['target_type' => 'question', 'target_id' => $question->id, 'body' => 'Thanks'])->assertCreated();
    // The author is not connected to the student, so the notice names nobody.
    Notification::assertSentTo($author, CommentPosted::class, function (CommentPosted $n, array $channels, User $to) {
        $data = $n->toArray($to);

        return ! array_key_exists('user', $data) && $data['commenter_role'] === Role::Student && $data['is_reply'] === false;
    });
});

test('comments on a course reach the course page\'s audience only while the course is public', function () {
    $author = aTeacher();
    $course = Course::factory()->for($author, 'author')->create(['visibility' => 'public', 'published_at' => now()]);
    commentOn($author, 'course', $course->id);
    $this->actingAs(aStudent());
    $this->getJson(threadQuery('course', $course->id))->assertOk()->assertJsonCount(1, 'data');

    $course->update(['visibility' => 'private']);
    $this->getJson(threadQuery('course', $course->id))->assertNotFound();
});
