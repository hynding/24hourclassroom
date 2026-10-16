<?php

namespace App\Enums;

/**
 * Where a comment stands in moderation. Mirrored as COMMENT_STATUSES in
 * packages/shared. Only a public course's discussion is moderated: a comment
 * there starts Pending unless its writer may approve it (CommentAccess), and
 * everywhere else starts Approved. Deletion is not a status: a deleted
 * comment is soft-deleted and only administrators see it.
 */
enum CommentStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Denied = 'denied';
}
