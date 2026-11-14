<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CommentStatus;
use App\Enums\CommentTarget;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Support\CommentAccess;
use App\Support\CommentNotifier;
use App\Support\FrontendRedirect;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Every comment on the site in one list, newest first, for moderating across
 * courses without opening each discussion: search, filter by status (pending,
 * approved, denied, deleted) and kind of target, then approve, deny, delete
 * or restore. The same rules as the API (CommentAccess): only a course's
 * discussion has approvals, deleting takes the replies with it, and a
 * deleted comment is soft-deleted, so restoring brings it back.
 */
class CommentAdminController extends Controller
{
    /** The statuses the list filters on: the enum's, plus deleted. */
    private const FILTERS = ['pending', 'approved', 'denied', 'deleted'];

    public function index(Request $request): Response
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', Rule::in(self::FILTERS)],
            'target' => ['nullable', Rule::enum(CommentTarget::class)],
        ]);
        $term = $filters['q'] ?? null;
        $status = $filters['status'] ?? null;
        $target = isset($filters['target']) ? CommentTarget::from($filters['target']) : null;

        $comments = Comment::withTrashed()
            ->with(['author', 'parent', 'test', 'question.test', 'material', 'course'])
            ->when($status === 'deleted', fn (Builder $q) => $q->whereNotNull('deleted_at'))
            ->when($status !== null && $status !== 'deleted', fn (Builder $q) => $q->whereNull('deleted_at')->where('status', $status))
            ->when($target, fn (Builder $q, CommentTarget $t) => $q->whereNotNull($t->column()))
            ->when($term, function (Builder $q, string $term) {
                $like = '%'.addcslashes($term, '\\%_').'%';
                $q->where(fn (Builder $q) => $q->where('body', 'like', $like)
                    ->orWhereHas('author', fn (Builder $a) => $a->where('name', 'like', $like)));
            })
            ->orderByDesc('id')
            ->paginate(25)
            ->withQueryString()
            ->through(fn (Comment $c) => $this->row($c));

        return Inertia::render('admin/comments', [
            'comments' => $comments,
            'filters' => ['q' => $term, 'status' => $status, 'target' => $target?->value],
            'pendingCount' => Comment::where('status', CommentStatus::Pending)->count(),
        ]);
    }

    public function approve(Comment $comment): RedirectResponse
    {
        return $this->moderate($comment, CommentStatus::Approved);
    }

    public function deny(Comment $comment): RedirectResponse
    {
        return $this->moderate($comment, CommentStatus::Denied);
    }

    /** Soft, with its replies, exactly as the API's delete. */
    public function destroy(Comment $comment): RedirectResponse
    {
        DB::transaction(function () use ($comment) {
            $comment->replies()->update(['deleted_at' => now()]);
            $comment->delete();
        });

        return back();
    }

    /**
     * Undoes a delete: the comment and the replies that were deleted with it
     * (same second or later -- a reply deleted on its own earlier stays
     * deleted). A reply under a still-deleted comment cannot come back alone.
     */
    public function restore(Comment $comment): RedirectResponse
    {
        if (! $comment->trashed()) {
            return back();
        }
        abort_if($comment->parent?->trashed(), 422, 'Restore the comment it replies to first.');

        DB::transaction(function () use ($comment) {
            Comment::onlyTrashed()
                ->where('parent_id', $comment->id)
                ->where('deleted_at', '>=', $comment->deleted_at)
                ->update(['deleted_at' => null]);
            $comment->restore();
        });

        return back();
    }

    private function moderate(Comment $comment, CommentStatus $status): RedirectResponse
    {
        // Approval exists only on a course's discussion (CommentAccess::canApprove);
        // everywhere else a comment is simply approved.
        abort_unless($comment->targetType() === CommentTarget::Course && ! $comment->trashed(), 422, 'Only a course discussion has approvals.');

        if ($comment->status !== $status) {
            $comment->update(['status' => $status]);
            if ($status === CommentStatus::Approved && $comment->parent_id !== null) {
                // The reply's notice to the person it answers was held back.
                CommentNotifier::notify($comment, $comment->parent, CommentTarget::Course, $comment->course, $comment->author, toOwner: false);
            }
        }

        return back();
    }

    /** @return array<string, mixed> */
    private function row(Comment $c): array
    {
        $type = $c->targetType();
        $target = match ($type) {
            CommentTarget::Test => $c->test,
            CommentTarget::Question => $c->question,
            CommentTarget::Material => $c->material,
            CommentTarget::Course => $c->course,
        };
        $path = match ($type) {
            CommentTarget::Test => "/tests/{$c->test_id}",
            CommentTarget::Question => $target ? "/tests/{$target->test_id}" : null,
            CommentTarget::Material => "/materials/{$c->material_id}",
            CommentTarget::Course => "/courses/{$c->course_id}",
        };

        return [
            'id' => $c->id,
            'body' => $c->body,
            'status' => $c->status->value,
            'created_at' => $c->created_at,
            'edited_at' => $c->edited_at,
            'deleted_at' => $c->deleted_at,
            'is_reply' => $c->parent_id !== null,
            'parent_deleted' => $c->parent_id !== null && (bool) $c->parent?->trashed(),
            'author' => $c->author
                ? ['id' => $c->author->id, 'name' => $c->author->name, 'role' => $c->author->role->label()]
                : null,
            'target' => [
                'type' => $type->value,
                'title' => $target ? CommentAccess::title($type, $target) : '(removed)',
                'url' => $path ? FrontendRedirect::spaOrigin().$path : null,
            ],
            'moderated' => $type === CommentTarget::Course,
        ];
    }
}
