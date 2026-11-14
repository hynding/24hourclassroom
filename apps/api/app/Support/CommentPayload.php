<?php

namespace App\Support;

use App\Enums\CommentReaction;
use App\Models\Comment;
use App\Models\Reaction;
use App\Models\User;

final class CommentPayload
{
    /**
     * Replies must already be narrowed by CommentAccess::visible(); with
     * thumbs on, `reactions` must be loaded on each comment.
     *
     * @return array<string, mixed>
     */
    public static function for(Comment $comment, CommentContext $ctx): array
    {
        $viewer = $ctx->viewer;
        $payload = [
            'id' => $comment->id,
            'parent_id' => $comment->parent_id,
            'body' => $comment->body,
            'status' => $comment->status,
            // Only an administrator is ever sent a deleted comment.
            'deleted_at' => $comment->deleted_at,
            'created_at' => $comment->created_at,
            'edited_at' => $comment->edited_at,
            'author' => self::author($comment->author, $ctx->named),
            'is_mine' => $viewer !== null && $viewer->id === $comment->user_id,
            'can_edit' => ! $comment->trashed() && CommentAccess::canEdit($viewer, $comment),
            'can_delete' => ! $comment->trashed() && CommentAccess::canDelete($viewer, $comment, $ctx->ownerId),
            'reactions' => self::reactions($comment, $ctx),
            'can_react' => CommentAccess::canReact($ctx, $comment),
        ];

        if ($comment->parent_id === null) {
            $payload['replies'] = $comment->replies
                ->map(fn (Comment $reply) => self::for($reply, $ctx))
                ->values()
                ->all();
        }

        return $payload;
    }

    /**
     * Counts and the viewer's own choice, on an approved comment where the
     * course has thumbs switched on; null everywhere else.
     *
     * @return array{up: int, down: int, mine: ?string}|null
     */
    private static function reactions(Comment $comment, CommentContext $ctx): ?array
    {
        if (! $ctx->reactions || ! $comment->isApproved()) {
            return null;
        }
        $all = $comment->reactions;
        $mine = $ctx->viewer === null ? null : $all->first(fn (Reaction $r) => $r->user_id === $ctx->viewer->id);

        return [
            'up' => $all->where('value', CommentReaction::Up)->count(),
            'down' => $all->where('value', CommentReaction::Down)->count(),
            'mine' => $mine?->value->value,
        ];
    }

    /**
     * UserSummary when the viewer may know who this is; otherwise the role
     * alone, with every other key present and null so the shape does not
     * itself say which case this is.
     *
     * @param  list<int>|true  $named
     * @return array<string, mixed>
     */
    public static function author(User $commenter, array|bool $named): array
    {
        if (CommentAccess::revealsAuthor($commenter, $named)) {
            return UserSummary::for($commenter);
        }

        return ['id' => null, 'name' => null, 'role' => $commenter->role, 'avatar_url' => null];
    }
}
