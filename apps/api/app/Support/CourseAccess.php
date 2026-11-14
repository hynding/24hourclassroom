<?php

namespace App\Support;

use App\Enums\Role;
use App\Models\Course;
use App\Models\CourseItem;
use App\Models\Test;
use App\Models\User;

/**
 * Every visibility decision for a course, in one place. Same rule as tests
 * and materials: a hidden course and a missing course are indistinguishable
 * (404, never 403).
 *
 * A public course shows a visitor only the items that are themselves public
 * -- publishing a course publishes its contents (CourseWriter), and an
 * administrator unpublishing one test or material takes it out of every
 * course with it. The author always sees the whole list of their own items.
 *
 * Tests are always the course author's own, so their answers stay under the
 * author's control. A material may be another teacher's: a branch keeps the
 * original's readings rather than copying the files (CourseBrancher).
 */
final class CourseAccess
{
    public static function canView(?User $viewer, Course $course): bool
    {
        if (self::canAuthor($viewer, $course)) {
            return true;
        }

        return $course->isPublic() && $course->author->isActive();
    }

    /**
     * Ownership only -- the teacher-role gate is applied at creation. Tying
     * this to `Role::Teacher` would lock an author promoted to admin out of
     * their own courses (the frozen-role defect class).
     */
    public static function canAuthor(?User $user, Course $course): bool
    {
        return $user !== null && $user->id === $course->user_id;
    }

    /**
     * Whether this entry appears on the course page for this viewer. The
     * caller has already established that the viewer may see the course.
     *
     * The author's own item: always to the author, to anyone else while it
     * is public. Someone else's MATERIAL (kept from a branched course): to
     * everyone, the author included, only while it is public and its author
     * active -- exactly when it is in the public library. Someone else's
     * TEST: never; SaveCourseRequest refuses one, and this keeps a later
     * change of ownership from carrying one into a stranger's course.
     *
     * The per-course counts apply the same rule in SQL (CourseController,
     * CourseLibraryController); change them together.
     */
    public static function showsItem(?User $viewer, Course $course, CourseItem $item): bool
    {
        $target = $item->test ?? $item->material;
        if ($target === null) {
            return false;
        }
        if ($target->user_id !== $course->user_id) {
            return $item->material !== null && $target->isPublic() && $target->author->isActive();
        }

        return self::canAuthor($viewer, $course) || $target->isPublic();
    }

    /**
     * Branching is for OTHER teachers, like copying a test: the author
     * already owns the original. Allowlist: only a role that `authors()`. The caller
     * has already established the viewer may see the course, which for a
     * non-author means it is public.
     */
    public static function canBranch(?User $viewer, Course $course): bool
    {
        return $viewer !== null
            && $viewer->role->authors()
            && $course->isPublic()
            && ! self::canAuthor($viewer, $course);
    }

    /**
     * Practice mode: the course's test with its answers. Only through a
     * course the viewer may see, only a test listed in it, and -- for anyone
     * but the author -- only a test that is itself public. An assigned
     * student reaching a PRIVATE test through its assignment gets nothing
     * here: answers travel with the course being public, not with the test
     * being visible.
     */
    public static function canPractice(?User $viewer, Course $course, Test $test): bool
    {
        if (! self::canView($viewer, $course) || $test->user_id !== $course->user_id) {
            return false;
        }
        if (! $course->items()->where('test_id', $test->id)->exists()) {
            return false;
        }

        return self::canAuthor($viewer, $course) || $test->isPublic();
    }

    public static function assertViewer(?User $viewer, Course $course): void
    {
        abort_unless(self::canView($viewer, $course), 404);
    }

    /**
     * 404 if the caller may not even see the course. Otherwise a non-author
     * gets 403 on a PUBLIC course (its existence is already public) and 404
     * on a private one.
     */
    public static function assertAuthor(?User $user, Course $course): void
    {
        self::assertViewer($user, $course);
        if (! self::canAuthor($user, $course)) {
            abort($course->isPublic() ? 403 : 404);
        }
    }

    public static function assertPractice(?User $viewer, Course $course, Test $test): void
    {
        abort_unless(self::canPractice($viewer, $course, $test), 404);
    }
}
