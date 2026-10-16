<?php

namespace App\Enums;

/**
 * A thumbs up or down on an approved comment, where the course allows them
 * (`courses.comment_reactions`). Mirrored as COMMENT_REACTIONS in
 * packages/shared. One per person per comment.
 */
enum CommentReaction: string
{
    case Up = 'up';
    case Down = 'down';
}
