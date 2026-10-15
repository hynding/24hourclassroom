<?php

namespace App\Http\Controllers\Api;

use App\Enums\CommentTarget;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use App\Notifications\CommentPosted;
use App\Support\CommentAccess;
use App\Support\CommentPayload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * replies. Unpaginated: a discussion is read top to bottom.
     */
    public function index(Request $request): JsonResponse
    {
        $viewer = $request->user();
        [$type, $target] = $this->target($request, $viewer);
        $ownerId = CommentAccess::ownerId($type, $target);
        $named = CommentAccess::namedFor($viewer);

        $comments = Comment::query()
            ->where($type->column(), $target->getKey())
            ->whereNull('parent_id')
            ->whereHas('author', fn (Builder $q) => $q->whereNull('deactivated_at'))
            ->with([
                'author.profile',
                'replies' => fn ($q) => $q->whereHas('author', fn (Builder $a) => $a->whereNull('deactivated_at'))->with('author.profile'),
            ])
            ->orderBy('id')
            ->get();

        return response()->json([
            'data' => $comments->map(fn (Comment $c) => CommentPayload::for($c, $viewer, $named, $ownerId))->all(),
            'can_comment' => CommentAccess::canPost($viewer, $type, $target),
            'can_moderate' => CommentAccess::canModerate($viewer, $ownerId),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $viewer = $request->user();
        [$type, $target] = $this->target($request, $viewer);
        abort_unless(CommentAccess::canPost($viewer, $type, $target), 403);

        $data = $request->validate([
            'body' => ['required', 'string', 'max:'.self::MAX_BODY],
            'parent_id' => ['nullable', 'integer'],
        ]);

        $parent = null;
        if (! empty($data['parent_id'])) {
            $parent = Comment::query()
                ->where($type->column(), $target->getKey())
                ->whereKey($data['parent_id'])
                ->whereHas('author', fn (Builder $q) => $q->whereNull('deactivated_at'))
                ->first();
            if ($parent === null) {
                return response()->json([
                    'message' => 'That comment is no longer there.',
                    'errors' => ['parent_id' => ['That comment is no longer there.']],
                ], 422);
            }
            // One level of replies: answering a reply joins its thread.
            $parent = $parent->parent ?? $parent;
        }

        $comment = Comment::create([
            'user_id' => $viewer->id,
            'parent_id' => $parent?->id,
            $type->column() => $target->getKey(),
            'body' => $data['body'],
        ]);
        $comment->setRelation('author', $viewer->loadMissing('profile'));
        $comment->setRelation('replies', collect());

        $this->notify($comment, $parent, $type, $target, $viewer);

        $ownerId = CommentAccess::ownerId($type, $target);

        return response()->json(CommentPayload::for($comment, $viewer, CommentAccess::namedFor($viewer), $ownerId), 201);
    }

    public function update(Request $request, Comment $comment): JsonResponse
    {
        $viewer = $request->user();
        [, , $ownerId] = $this->visibleComment($comment, $viewer);
        abort_unless(CommentAccess::canEdit($viewer, $comment), 403);

        $data = $request->validate(['body' => ['required', 'string', 'max:'.self::MAX_BODY]]);
        if ($data['body'] !== $comment->body) {
            $comment->update(['body' => $data['body'], 'edited_at' => now()]);
        }
        $comment->load(['author.profile', 'replies.author.profile']);

        return response()->json(CommentPayload::for($comment, $viewer, CommentAccess::namedFor($viewer), $ownerId));
    }

    /** Deleting a comment deletes its replies with it. */
    public function destroy(Request $request, Comment $comment): Response
    {
        $viewer = $request->user();
        [, , $ownerId] = $this->visibleComment($comment, $viewer);
        abort_unless(CommentAccess::canDelete($viewer, $comment, $ownerId), 403);

        $comment->delete();

        return response()->noContent();
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
     * on show: a hidden comment and a missing one look the same.
     *
     * @return array{0: CommentTarget, 1: Model, 2: int}
     */
    private function visibleComment(Comment $comment, ?User $viewer): array
    {
        $type = $comment->targetType();
        $target = CommentAccess::targetOf($comment);
        abort_unless($target !== null && CommentAccess::canView($viewer, $type, $target), 404);
        abort_unless($comment->author->isActive(), 404);
        abort_if($comment->parent !== null && ! $comment->parent->author->isActive(), 404);

        return [$type, $target, CommentAccess::ownerId($type, $target)];
    }

    /**
     * The target's author when someone else comments, and the writer of the
     * comment being answered. Each person once, never the commenter, and
     * only people who can still see the target.
     */
    private function notify(Comment $comment, ?Comment $parent, CommentTarget $type, Model $target, User $commenter): void
    {
        $recipients = [CommentAccess::ownerId($type, $target) => false];
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
