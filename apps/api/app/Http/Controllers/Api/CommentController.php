<?php

namespace App\Http\Controllers\Api;

use App\Enums\CommentReaction;
use App\Enums\CommentStatus;
use App\Enums\CommentTarget;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Reaction;
use App\Models\User;
use App\Notifications\CommentPosted;
use App\Support\CommentAccess;
use App\Support\CommentContext;
use App\Support\CommentPayload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

/**
 * Comments on a test, one of its questions, a material or a course. Every
 * rule lives in CommentAccess; this controller only resolves the target and
 * applies them. Comments by deactivated people are hidden, not deleted, the
 * same as everything else they wrote (decision 4).
 */
class CommentController extends Controller
{
    public const MAX_BODY = 2000;

    /**
     * The whole discussion, oldest first, each top-level comment with its
     * replies, narrowed to what this viewer may see. Unpaginated: a
     * discussion is read top to bottom.
     */
    public function index(Request $request): JsonResponse
    {
        $viewer = $request->user();
        [$type, $target] = $this->target($request, $viewer);
        $ctx = CommentContext::for($viewer, $type, $target);

        $comments = CommentAccess::visible(Comment::query(), $viewer, $ctx->approver)
            ->where($type->column(), $target->getKey())
            ->whereNull('parent_id')
            ->with($this->relations($ctx))
            ->orderBy('id')
            ->get();

        return response()->json([
            'data' => $comments->map(fn (Comment $c) => CommentPayload::for($c, $ctx))->all(),
            'can_comment' => $ctx->canPost,
            'can_moderate' => CommentAccess::canModerate($viewer, $ctx->ownerId),
            'can_approve' => $ctx->approver,
            'moderated' => CommentAccess::isModerated($type, $target),
            'reactions_enabled' => $ctx->reactions,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $viewer = $request->user();
        [$type, $target] = $this->target($request, $viewer);
        $ctx = CommentContext::for($viewer, $type, $target);
        abort_unless($ctx->canPost, 403);

        $data = $request->validate([
            'body' => ['required', 'string', 'max:'.self::MAX_BODY],
            'parent_id' => ['nullable', 'integer'],
        ]);

        $parent = null;
        if (! empty($data['parent_id'])) {
            // Only a comment this viewer can see, and never a denied one.
            $parent = CommentAccess::visible(Comment::query(), $viewer, $ctx->approver)
                ->withoutTrashed()
                ->where($type->column(), $target->getKey())
                ->where('status', '!=', CommentStatus::Denied)
                ->whereKey($data['parent_id'])
                ->first();
            if ($parent === null) {
                return response()->json([
                    'message' => 'That comment is no longer there.',
                    'errors' => ['parent_id' => ['That comment is no longer there.']],
                ], 422);
            }
            // One level of replies: answering a reply joins its thread.
            $parent = $parent->parent ?? $parent;
            if ($parent->trashed() || ! CommentAccess::canSee($viewer, $parent, $ctx->approver)) {
                return response()->json([
                    'message' => 'That comment is no longer there.',
                    'errors' => ['parent_id' => ['That comment is no longer there.']],
                ], 422);
            }
        }

        $comment = Comment::create([
            'user_id' => $viewer->id,
            'parent_id' => $parent?->id,
            $type->column() => $target->getKey(),
            'body' => $data['body'],
            'status' => CommentAccess::statusFor($viewer, $type, $target),
        ]);
        $comment->setRelation('author', $viewer->loadMissing('profile'));
        $comment->setRelation('replies', collect());
        $comment->setRelation('reactions', collect());

        // A reply waiting for approval reaches the person it answers once
        // it is approved; the course's author hears of it now, to approve it.
        $this->notify($comment, $comment->isApproved() ? $parent : null, $type, $target, $viewer, toOwner: true);

        return response()->json(CommentPayload::for($comment, $ctx), 201);
    }

    /**
     * On a moderated discussion an edit by anyone but an approver goes back
     * for approval, so an approved comment cannot be rewritten unseen.
     */
    public function update(Request $request, Comment $comment): JsonResponse
    {
        $viewer = $request->user();
        $ctx = $this->visibleComment($comment, $viewer);
        abort_unless(CommentAccess::canEdit($viewer, $comment), 403);

        $data = $request->validate(['body' => ['required', 'string', 'max:'.self::MAX_BODY]]);
        if ($data['body'] !== $comment->body) {
            $comment->update([
                'body' => $data['body'],
                'edited_at' => now(),
                'status' => CommentAccess::isModerated($ctx->type, $ctx->target) && ! $ctx->approver
                    ? CommentStatus::Pending
                    : $comment->status,
            ]);
        }

        return response()->json(CommentPayload::for($comment->load($this->relations($ctx)), $ctx));
    }

    /**
     * Deleting a comment deletes its replies with it. Both are kept for
     * administrators (soft-deleted); nobody else sees them again.
     */
    public function destroy(Request $request, Comment $comment): Response
    {
        $viewer = $request->user();
        $ctx = $this->visibleComment($comment, $viewer);
        abort_unless(CommentAccess::canDelete($viewer, $comment, $ctx->ownerId), 403);

        DB::transaction(function () use ($comment) {
            $comment->replies()->update(['deleted_at' => now()]);
            $comment->delete();
        });

        return response()->noContent();
    }

    public function approve(Request $request, Comment $comment): JsonResponse
    {
        return $this->moderate($request, $comment, CommentStatus::Approved);
    }

    public function deny(Request $request, Comment $comment): JsonResponse
    {
        return $this->moderate($request, $comment, CommentStatus::Denied);
    }

    /**
     * Thumbs up, thumbs down, or neither (`value: null`). One per person per
     * comment; choosing again replaces it.
     */
    public function react(Request $request, Comment $comment): JsonResponse
    {
        $viewer = $request->user();
        $ctx = $this->visibleComment($comment, $viewer);
        abort_unless(CommentAccess::canReact($ctx, $comment), 403);

        $data = $request->validate(['value' => ['present', 'nullable', Rule::enum(CommentReaction::class)]]);
        if ($data['value'] === null) {
            $comment->reactions()->where('user_id', $viewer->id)->delete();
        } else {
            Reaction::updateOrCreate(
                ['comment_id' => $comment->id, 'user_id' => $viewer->id],
                ['value' => $data['value']],
            );
        }

        return response()->json(CommentPayload::for($comment->load($this->relations($ctx)), $ctx));
    }

    private function moderate(Request $request, Comment $comment, CommentStatus $status): JsonResponse
    {
        $viewer = $request->user();
        $ctx = $this->visibleComment($comment, $viewer);
        abort_unless($ctx->approver, 403);

        if ($comment->status !== $status) {
            $comment->update(['status' => $status]);
            if ($status === CommentStatus::Approved && $comment->parent_id !== null) {
                // The reply's notice to the person it answers was held back.
                $this->notify($comment, $comment->parent, $ctx->type, $ctx->target, $comment->author, toOwner: false);
            }
        }

        return response()->json(CommentPayload::for($comment->load($this->relations($ctx)), $ctx));
    }

    /** @return array<int|string, mixed> */
    private function relations(CommentContext $ctx): array
    {
        $replies = fn ($q) => CommentAccess::visible($q, $ctx->viewer, $ctx->approver)
            ->with($ctx->reactions ? ['author.profile', 'reactions'] : ['author.profile']);

        return [
            'author.profile',
            'replies' => $replies,
            ...($ctx->reactions ? ['reactions'] : []),
        ];
    }

    /** @return array{0: CommentTarget, 1: Model} */
    private function target(Request $request, ?User $viewer): array
    {
        $data = $request->validate([
            'target_type' => ['required', Rule::enum(CommentTarget::class)],
            'target_id' => ['required', 'integer', 'min:1'],
        ]);
        $type = CommentTarget::from($data['target_type']);
        $target = CommentAccess::resolve($type, (int) $data['target_id']);
        abort_unless($target !== null && CommentAccess::canView($viewer, $type, $target), 404);

        return [$type, $target];
    }

    /**
     * 404 unless the viewer can see the comment's target and the comment is
     * on show to them: a hidden comment and a missing one look the same. A
     * deleted comment never binds, so nothing acts on one.
     */
    private function visibleComment(Comment $comment, ?User $viewer): CommentContext
    {
        $type = $comment->targetType();
        $target = CommentAccess::targetOf($comment);
        abort_unless($target !== null && CommentAccess::canView($viewer, $type, $target), 404);
        $ctx = CommentContext::for($viewer, $type, $target);

        abort_unless($comment->author->isActive() && CommentAccess::canSee($viewer, $comment, $ctx->approver), 404);
        $parent = $comment->parent;
        abort_if($parent !== null && ($parent->trashed() || ! $parent->author->isActive() || ! CommentAccess::canSee($viewer, $parent, $ctx->approver)), 404);

        return $ctx;
    }

    /**
     * The target's author when someone else comments, and the writer of the
     * comment being answered. Each person once, never the commenter, and
     * only people who can still see the target.
     */
    private function notify(Comment $comment, ?Comment $parent, CommentTarget $type, Model $target, User $commenter, bool $toOwner): void
    {
        $recipients = $toOwner ? [CommentAccess::ownerId($type, $target) => false] : [];
        if ($parent !== null) {
            $recipients[$parent->user_id] = true;
        }
        unset($recipients[$commenter->id]);

        $title = CommentAccess::title($type, $target);
        $testId = match ($type) {
            CommentTarget::Test => $target->getKey(),
            CommentTarget::Question => $target->test_id,
            default => null,
        };

        foreach (User::whereIn('id', array_keys($recipients))->whereNull('deactivated_at')->get() as $user) {
            if (! CommentAccess::canView($user, $type, $target)) {
                continue;
            }
            $user->notify(new CommentPosted($comment, $type, $target->getKey(), $title, $testId, $recipients[$user->id]));
        }
    }
}
