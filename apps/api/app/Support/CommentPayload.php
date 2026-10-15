<?php

namespace App\Support;

use App\Models\Comment;
use App\Models\User;

final class CommentPayload
{
    /**
     * @param  list<int>|true  $named  CommentAccess::namedFor($viewer)
     * @return array<string, mixed>
     */
    public static function for(Comment $comment, ?User $viewer, array|bool $named, int $ownerId): array
    {
        $payload = [
            'id' => $comment->id,
            'parent_id' => $comment->parent_id,
            'body' => $comment->body,
            'created_at' => $comment->created_at,
            'edited_at' => $comment->edited_at,
            'author' => self::author($comment->author, $named),
            'is_mine' => $viewer !== null && $viewer->id === $comment->user_id,
            'can_edit' => CommentAccess::canEdit($viewer, $comment),
            'can_delete' => CommentAccess::canDelete($viewer, $comment, $ownerId),
        ];

        if ($comment->parent_id === null) {
            $payload['replies'] = $comment->replies
                ->map(fn (Comment $reply) => self::for($reply, $viewer, $named, $ownerId))
                ->values()
                ->all();
        }

        return $payload;
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
