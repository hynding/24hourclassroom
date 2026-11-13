<?php

namespace App\Support;

use App\Enums\CommentTarget;
use App\Models\Comment;
use App\Models\User;
use App\Notifications\CommentPosted;
use Illuminate\Database\Eloquent\Model;

/** Who hears about a comment. Shared by the API and the admin comment list. */
final class CommentNotifier
{
    /**
     * The target's author when someone else comments, and the writer of the
     * comment being answered. Each person once, never the commenter, and
     * only people who can still see the target.
     */
    public static function notify(Comment $comment, ?Comment $parent, CommentTarget $type, Model $target, User $commenter, bool $toOwner): void
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
