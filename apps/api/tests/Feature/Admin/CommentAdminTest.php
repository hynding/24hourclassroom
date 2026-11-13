<?php

use App\Enums\Role;
use App\Models\Comment;
use App\Models\User;
use App\Notifications\CommentPosted;

function adminCommentFixture(): array
{
    $author = aTeacher(['name' => 'Ms A']);
    $test = aTestWithQuestions($author, 1, ['title' => 'Cells quiz']);
    $course = aCourse($author, [], ['title' => 'Biology', 'visibility' => 'public', 'published_at' => now()]);
    $student = aStudent(['name' => 'Sam']);

    $onTest = Comment::create(['user_id' => $student->id, 'test_id' => $test->id, 'body' => 'Question about item two']);
    $pending = Comment::create(['user_id' => $student->id, 'course_id' => $course->id, 'body' => 'Is unit 3 on the exam?', 'status' => 'pending']);
    $top = Comment::create(['user_id' => $author->id, 'course_id' => $course->id, 'body' => 'Welcome, everyone']);
    $reply = Comment::create(['user_id' => $student->id, 'course_id' => $course->id, 'parent_id' => $top->id, 'body' => 'Thanks!', 'status' => 'pending']);

    return compact('author', 'test', 'course', 'student', 'onTest', 'pending', 'top', 'reply');
}

test('only an admin reaches the comment list and its actions', function () {
    ['onTest' => $comment] = adminCommentFixture();
    foreach (Role::cases() as $role) {
        if ($role === Role::Admin) {
            continue;
        }
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        $this->get('/admin/comments')->assertStatus(403);
        $this->delete("/admin/comments/{$comment->id}")->assertStatus(403);
        $this->post("/admin/comments/{$comment->id}/restore")->assertStatus(403);
    }
    $this->app['auth']->forgetGuards();
    $this->get('/admin/comments')->assertRedirect('/login');
    expect($comment->fresh()->trashed())->toBeFalse();
});

test('the admin lists every comment newest first, with filters and a link to its page', function () {
    ['onTest' => $onTest, 'pending' => $pending, 'top' => $top, 'reply' => $reply, 'test' => $test] = adminCommentFixture();
    $this->actingAs(User::factory()->create(['role' => 'admin']));

    $page = $this->get('/admin/comments')->assertOk()->viewData('page')['props'];
    $rows = $page['comments']['data'];
    expect(collect($rows)->pluck('id')->all())->toBe([$reply->id, $top->id, $pending->id, $onTest->id])
        ->and($page['pendingCount'])->toBe(2)
        ->and($rows[3]['target']['type'])->toBe('test')
        ->and($rows[3]['target']['title'])->toBe('Cells quiz')
        ->and($rows[3]['target']['url'])->toEndWith("/tests/{$test->id}")
        ->and($rows[3]['author']['name'])->toBe('Sam')
        ->and($rows[3]['moderated'])->toBeFalse()
        ->and($rows[0]['is_reply'])->toBeTrue();

    $ids = fn (string $query) => collect($this->get("/admin/comments?{$query}")->viewData('page')['props']['comments']['data'])->pluck('id')->all();
    expect($ids('status=pending'))->toBe([$reply->id, $pending->id])
        ->and($ids('target=test'))->toBe([$onTest->id])
        ->and($ids('q=unit+3'))->toBe([$pending->id])
        ->and($ids('q=Ms+A'))->toBe([$top->id])
        ->and($ids('status=deleted'))->toBe([]);
});

test('the admin approves and denies a course comment, which notifies a held-back reply', function () {
    ['top' => $top, 'reply' => $reply, 'pending' => $pending, 'onTest' => $onTest, 'author' => $author] = adminCommentFixture();
    $this->actingAs(User::factory()->create(['role' => 'admin']));

    $this->post("/admin/comments/{$pending->id}/deny")->assertRedirect();
    expect($pending->fresh()->status->value)->toBe('denied');

    $this->post("/admin/comments/{$reply->id}/approve")->assertRedirect();
    expect($reply->fresh()->status->value)->toBe('approved')
        ->and($author->notifications()->where('type', CommentPosted::class)->count())->toBe(1);

    // A test's discussion has no approvals.
    $this->post("/admin/comments/{$onTest->id}/deny")->assertStatus(422);
    expect($onTest->fresh()->status->value)->toBe('approved');
});

test('deleting takes the replies along; restoring brings back both', function () {
    ['top' => $top, 'reply' => $reply] = adminCommentFixture();
    $this->actingAs(User::factory()->create(['role' => 'admin']));

    $this->delete("/admin/comments/{$top->id}")->assertRedirect();
    expect($top->fresh()->trashed())->toBeTrue()->and($reply->fresh()->trashed())->toBeTrue();

    $rows = collect($this->get('/admin/comments?status=deleted')->viewData('page')['props']['comments']['data']);
    expect($rows->pluck('id')->all())->toBe([$reply->id, $top->id])
        ->and($rows->firstWhere('id', $reply->id)['parent_deleted'])->toBeTrue();

    // A reply cannot come back on its own while its parent is deleted.
    $this->post("/admin/comments/{$reply->id}/restore")->assertStatus(422);

    $this->post("/admin/comments/{$top->id}/restore")->assertRedirect();
    expect($top->fresh()->trashed())->toBeFalse()->and($reply->fresh()->trashed())->toBeFalse();
});
