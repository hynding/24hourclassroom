<?php

namespace App\Support;

use App\Enums\CommentTarget;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Everything CommentAccess decides about one viewer on one discussion,
 * resolved once per request so a payload of many comments asks nothing of
 * the database per comment.
 */
final class CommentContext
{
    /** @param  list<int>|true  $named  CommentAccess::namedFor() */
    public function __construct(
        public readonly ?User $viewer,
        public readonly CommentTarget $type,
        public readonly Model $target,
        public readonly array|bool $named,
        public readonly int $ownerId,
        public readonly bool $approver,
        public readonly bool $reactions,
        public readonly bool $canPost,
    ) {}

    public static function for(?User $viewer, CommentTarget $type, Model $target): self
    {
        return new self(
            $viewer,
            $type,
            $target,
            CommentAccess::namedFor($viewer),
            CommentAccess::ownerId($type, $target),
            CommentAccess::canApprove($viewer, $type, $target),
            CommentAccess::reactionsEnabled($type, $target),
            CommentAccess::canPost($viewer, $type, $target),
        );
    }
}
