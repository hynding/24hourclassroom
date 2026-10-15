<?php

namespace App\Support;

use App\Enums\CommentTarget;
use App\Models\Comment;
use App\Models\Connection;
use App\Models\Course;
use App\Models\Material;
use App\Models\Question;
use App\Models\Test;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Every rule for comments, in one place. A discussion is exactly as visible
 * as the thing it is about: whoever may see a test (or its question), a
 * material or a course through TestAccess, MaterialAccess or CourseAccess may
 * read its comments, and a hidden target and a missing one are
 * indistinguishable (404).
 *
 * Who speaks and who moderates are Role allowlists (comments(),
 * moderatesComments()). The target's own author may also delete any comment
 * on it: it is their test, material or course.
 *
 * Names follow decision 5. A commenter whose role is public (teacher, tutor)
 * is named to everyone; anyone else is named only to themselves, to people
 * they hold an accepted connection with, and to administrators. Everyone
 * else sees the role alone ("A student").
 */
final class CommentAccess
{
    /** The live target, or null when it does not exist (a trashed question included). */
    public static function resolve(CommentTarget $type, int $id): ?Model
    {
        return match ($type) {
            CommentTarget::Test => Test::find($id),
            CommentTarget::Question => Question::with('test')->find($id),
            CommentTarget::Material => Material::find($id),
            CommentTarget::Course => Course::find($id),
        };
    }

    /** The comment's target, or null when it has gone. */
    public static function targetOf(Comment $comment): ?Model
    {
        return self::resolve($comment->targetType(), $comment->targetId());
    }

    public static function canView(?User $viewer, CommentTarget $type, Model $target): bool
    {
        return match ($type) {
            CommentTarget::Test => TestAccess::canView($viewer, $target),
            CommentTarget::Question => $target->test !== null && TestAccess::canView($viewer, $target->test),
            CommentTarget::Material => MaterialAccess::canView($viewer, $target),
            CommentTarget::Course => CourseAccess::canView($viewer, $target),
        };
    }

    public static function canPost(?User $viewer, CommentTarget $type, Model $target): bool
    {
        return $viewer !== null && $viewer->role->comments() && self::canView($viewer, $type, $target);
    }

    /** The person whose test, material or course this is. */
    public static function ownerId(CommentTarget $type, Model $target): int
    {
        return $type === CommentTarget::Question ? $target->test->user_id : $target->user_id;
    }

    /** Only the writer, and only while their role still takes part. */
    public static function canEdit(?User $viewer, Comment $comment): bool
    {
        return $viewer !== null && $viewer->id === $comment->user_id && $viewer->role->comments();
    }

    public static function canDelete(?User $viewer, Comment $comment, int $ownerId): bool
    {
        return $viewer !== null && ($viewer->id === $comment->user_id
            || $viewer->id === $ownerId
            || $viewer->role->moderatesComments());
    }

    /** Whether everything below the role moderation applies to this viewer. */
    public static function canModerate(?User $viewer, int $ownerId): bool
    {
        return $viewer !== null && ($viewer->id === $ownerId || $viewer->role->moderatesComments());
    }

    /**
     * The ids whose names this viewer may see beyond the public roles,
     * resolved once per request (Connection::acceptedCounterpartIds).
     *
     * @return list<int>|true true: every name (an administrator)
     */
    public static function namedFor(?User $viewer): array|bool
    {
        if ($viewer === null) {
            return [];
        }
        if ($viewer->role->moderatesComments()) {
            return true;
        }

        return [$viewer->id, ...Connection::acceptedCounterpartIds($viewer)];
    }

    /** @param  list<int>|true  $named */
    public static function revealsAuthor(User $commenter, array|bool $named): bool
    {
        return $named === true || $commenter->role->isPublic() || in_array($commenter->id, $named, true);
    }

    /** The target's display title, for notifications. */
    public static function title(CommentTarget $type, Model $target): string
    {
        return $type === CommentTarget::Question ? $target->test->title : $target->title;
    }
}
