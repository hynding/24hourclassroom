<?php

use App\Enums\CommentStatus;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Test;
use App\Models\User;
use App\Notifications\CommentPosted;
use Illuminate\Support\Facades\Notification;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

function publicCourse(User $author, array $attrs = []): Course
{
    return Course::factory()->for($author, 'author')->create(['visibility' => 'public', 'published_at' => now(), ...$attrs]);
}

function courseThread(Course $course): string
{
    return "/api/comments?target_type=course&target_id={$course->id}";
}

function postOn(Course $course, string $body = 'Hello', ?int $parent = null): array
{
    return ['target_type' => 'course', 'target_id' => $course->id, 'body' => $body, ...($parent ? ['parent_id' => $parent] : [])];
}

test('a comment on a public course waits for approval, seen only by its writer and the approvers', function () {
    $owner = aTeacher();
    $course = publicCourse($owner);
    $assistant = User::factory()->create(['role' => 'assistant']);
    connectAccepted($owner, $assistant);
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($writer = aStudent());
    $this->postJson('/api/comments', postOn($course, 'Is week 3 on the exam?'))->assertCreated()
        ->assertJsonPath('status', 'pending');
    $this->getJson(courseThread($course))->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.status', 'pending')
        ->assertJsonPath('moderated', true)
        ->assertJsonPath('can_approve', false);

    // Anyone else who can see the course sees nothing yet.
    $this->actingAs(aStudent());
    $this->getJson(courseThread($course))->assertOk()->assertJsonCount(0, 'data');
    $this->actingAs(User::factory()->create(['role' => 'assistant']));
    $this->getJson(courseThread($course))->assertOk()->assertJsonCount(0, 'data')->assertJsonPath('can_approve', false);

    // The course's author, a connected assistant and an admin see it, and approve.
    foreach ([$owner, $assistant, $admin] as $approver) {
        $this->actingAs($approver);
        $this->getJson(courseThread($course))->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.status', 'pending')
            ->assertJsonPath('can_approve', true);
    }
});

test('approving shows a comment to everyone; denying keeps it with its writer and the approvers', function () {
    $owner = aTeacher();
    $course = publicCourse($owner);
    $writer = aStudent();
    $first = Comment::create(['user_id' => $writer->id, 'course_id' => $course->id, 'body' => 'Good', 'status' => 'pending']);
    $second = Comment::create(['user_id' => $writer->id, 'course_id' => $course->id, 'body' => 'Rude', 'status' => 'pending']);

    // Only an approver may decide.
    $this->actingAs($writer);
    $this->postJson("/api/comments/{$first->id}/approve")->assertForbidden();
    $this->actingAs(aStudent());
    $this->postJson("/api/comments/{$first->id}/approve")->assertNotFound();

    $this->actingAs($owner);
    $this->postJson("/api/comments/{$first->id}/approve")->assertOk()->assertJsonPath('status', 'approved');
    $this->postJson("/api/comments/{$second->id}/deny")->assertOk()->assertJsonPath('status', 'denied');

    $this->actingAs(aStudent());
    $this->getJson(courseThread($course))->assertOk()
        ->assertJsonCount(1, 'data')->assertJsonPath('data.0.body', 'Good');

    $this->actingAs($writer);
    $this->getJson(courseThread($course))->assertOk()
        ->assertJsonCount(2, 'data')->assertJsonPath('data.1.status', 'denied');
    // A denied comment takes no replies.
    $this->postJson('/api/comments', postOn($course, 'Sorry', $second->id))->assertUnprocessable();
});

test('approvers\' own comments, and every comment off a public course, need no approval', function () {
    $owner = aTeacher();
    $course = publicCourse($owner);
    $this->actingAs($owner);
    $this->postJson('/api/comments', postOn($course, 'Welcome'))->assertCreated()->assertJsonPath('status', 'approved');

    $test = Test::factory()->published()->create();
    $this->actingAs(aStudent());
    $this->postJson('/api/comments', ['target_type' => 'test', 'target_id' => $test->id, 'body' => 'Hi'])
        ->assertCreated()->assertJsonPath('status', 'approved');
    $this->getJson("/api/comments?target_type=test&target_id={$test->id}")->assertOk()
        ->assertJsonPath('moderated', false)->assertJsonPath('can_approve', false);
});

test('an edit by the writer sends an approved comment back for approval', function () {
    $course = publicCourse(aTeacher());
    $writer = aStudent();
    $comment = Comment::create(['user_id' => $writer->id, 'course_id' => $course->id, 'body' => 'Nice', 'status' => 'approved']);

    $this->actingAs($writer);
    $this->patchJson("/api/comments/{$comment->id}", ['body' => 'Something else'])->assertOk()
        ->assertJsonPath('status', 'pending');
});

test('deleted comments and their replies are kept for admins and nobody else', function () {
    $owner = aTeacher();
    $course = publicCourse($owner);
    $top = Comment::create(['user_id' => aStudent()->id, 'course_id' => $course->id, 'body' => 'Top']);
    Comment::create(['user_id' => $owner->id, 'course_id' => $course->id, 'body' => 'Reply', 'parent_id' => $top->id]);

    $this->actingAs($owner);
    $this->deleteJson("/api/comments/{$top->id}")->assertNoContent();
    $this->getJson(courseThread($course))->assertOk()->assertJsonCount(0, 'data');
    expect(Comment::withTrashed()->count())->toBe(2)->and(Comment::count())->toBe(0);

    $this->actingAs(User::factory()->create(['role' => 'admin']));
    $this->getJson(courseThread($course))->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.body', 'Top')
        ->assertJsonPath('data.0.can_delete', false)
        ->assertJsonPath('data.0.replies.0.body', 'Reply');
    expect($this->getJson(courseThread($course))->json('data.0.deleted_at'))->not->toBeNull();
});

test('thumbs follow the course setting and only land on someone else\'s approved comment', function () {
    $owner = aTeacher();
    $course = publicCourse($owner);
    $writer = aStudent();
    $approved = Comment::create(['user_id' => $writer->id, 'course_id' => $course->id, 'body' => 'Approved']);
    $pending = Comment::create(['user_id' => $writer->id, 'course_id' => $course->id, 'body' => 'Waiting', 'status' => 'pending']);
    $voter = aStudent();

    // Off by default.
    $this->actingAs($voter);
    $this->putJson("/api/comments/{$approved->id}/reaction", ['value' => 'up'])->assertForbidden();
    $this->getJson(courseThread($course))->assertJsonPath('reactions_enabled', false)->assertJsonPath('data.0.reactions', null);

    $course->update(['comment_reactions' => true]);
    $this->putJson("/api/comments/{$approved->id}/reaction", ['value' => 'up'])->assertOk()
        ->assertJsonPath('reactions', ['up' => 1, 'down' => 0, 'mine' => 'up']);
    $this->putJson("/api/comments/{$approved->id}/reaction", ['value' => 'down'])->assertOk()
        ->assertJsonPath('reactions', ['up' => 0, 'down' => 1, 'mine' => 'down']);
    $this->putJson("/api/comments/{$approved->id}/reaction", ['value' => null])->assertOk()
        ->assertJsonPath('reactions', ['up' => 0, 'down' => 0, 'mine' => null]);
    $this->putJson("/api/comments/{$approved->id}/reaction", ['value' => 'sideways'])->assertUnprocessable();

    // Not your own, and not one awaiting approval.
    $this->actingAs($writer);
    $this->putJson("/api/comments/{$approved->id}/reaction", ['value' => 'up'])->assertForbidden();
    $this->actingAs($owner);
    $this->putJson("/api/comments/{$pending->id}/reaction", ['value' => 'up'])->assertForbidden();
});

test('the course\'s author switches thumbs on from the course editor\'s save', function () {
    $owner = aTeacher();
    $course = aCourse($owner);
    $this->actingAs($owner);
    $body = ['title' => $course->title, 'subject' => $course->subject->value, 'grade_level' => $course->grade_level->value, 'items' => []];

    $this->getJson("/api/courses/{$course->id}")->assertJsonPath('comment_reactions', false);
    $this->putJson("/api/courses/{$course->id}", [...$body, 'comment_reactions' => true])->assertOk()->assertJsonPath('comment_reactions', true);
    // Left out, the setting stays.
    $this->putJson("/api/courses/{$course->id}", $body)->assertOk()->assertJsonPath('comment_reactions', true);
});

test('a reply waiting for approval reaches the person it answers only once approved', function () {
    Notification::fake();
    $owner = aTeacher();
    $course = publicCourse($owner);
    $first = aTeacher();
    $top = Comment::create(['user_id' => $first->id, 'course_id' => $course->id, 'body' => 'Top']);

    $this->actingAs($replier = aTeacher());
    $id = $this->postJson('/api/comments', postOn($course, 'Agreed', $top->id))->assertCreated()->json('id');
    Notification::assertNotSentTo($first, CommentPosted::class);
    Notification::assertSentTo($owner, CommentPosted::class);

    $this->actingAs($owner);
    $this->postJson("/api/comments/{$id}/approve")->assertOk();
    Notification::assertSentTo($first, CommentPosted::class, fn (CommentPosted $n, array $c, User $to) => $n->toArray($to)['is_reply'] === true);
    expect(Comment::find($id)->status)->toBe(CommentStatus::Approved);
});
