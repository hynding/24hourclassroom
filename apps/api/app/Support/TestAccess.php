<?php

namespace App\Support;

use App\Enums\Role;
use App\Models\Test;
use App\Models\User;

/**
 * Every visibility decision for a test, in one place. Same rule as profiles:
 * a hidden test and a missing test are indistinguishable (404, never 403).
 */
final class TestAccess
{
    public static function canView(?User $viewer, Test $test): bool
    {
        if ($viewer && $viewer->id === $test->user_id) {
            return true;
        }

        if ($viewer && $test->assignments()->where('student_id', $viewer->id)->exists()) {
            return true;
        }

        return $test->isPublic() && $test->author->isActive();
    }

    /** Ownership only. Students see answers through a submitted attempt, never here. */
    public static function canSeeAnswers(?User $viewer, Test $test): bool
    {
        return $viewer !== null && $viewer->id === $test->user_id;
    }

    /**
     * Ownership only -- the teacher-role gate is applied at creation and copy.
     * Tying this to `Role::Teacher` would lock an author promoted to admin
     * out of their own tests (the frozen-role defect class).
     */
    public static function canAuthor(?User $user, Test $test): bool
    {
        return $user !== null && $user->id === $test->user_id;
    }

    /**
     * Copying is for OTHER teachers -- an author already owns the original,
     * so a self-copy is excluded even though the author can view and see
     * answers. Allowlist: only `Role::Teacher` may copy.
     */
    public static function canCopy(?User $viewer, Test $test): bool
    {
        return $viewer !== null && $viewer->role === Role::Teacher && $test->isPublic() && ! self::canAuthor($viewer, $test);
    }

    public static function assertViewer(?User $viewer, Test $test): void
    {
        abort_unless(self::canView($viewer, $test), 404);
    }

    /**
     * 404 if the caller may not even see the test. Otherwise a non-author gets
     * 403 on a PUBLIC test (its existence is already public) and 404 on a
     * private one (an assigned student must not learn it is editable).
     */
    public static function assertAuthor(?User $user, Test $test): void
    {
        self::assertViewer($user, $test);
        if (! self::canAuthor($user, $test)) {
            abort($test->isPublic() ? 403 : 404);
        }
    }
}
