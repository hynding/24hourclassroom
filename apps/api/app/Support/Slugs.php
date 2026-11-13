<?php

namespace App\Support;

use App\Enums\SlugKind;
use App\Enums\SlugStatus;
use App\Models\Course;
use App\Models\UrlSlug;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

/**
 * Every rule for vanity paths, in one place:
 *
 *   /teachers/<handle>                 a teacher's handle (admin-approved)
 *   /teachers/<handle>/<slug>          a course under it (auto-approved
 *                                      once the handle is)
 *   /courses/<slug>                    site-wide, set by an admin
 *
 * Ids keep working everywhere; a slug only adds a name. A path's canonical
 * form prefers the site slug, then the teacher's, then the id. A replaced
 * slug is retired, not deleted: it keeps resolving (the SPA rewrites the
 * address to the current one) and no one else can ever take it.
 *
 * Resolving never widens access: a slug reaches exactly what the id would,
 * through CourseAccess and the public-profile rule; anything else is a 404.
 */
final class Slugs
{
    public const MIN = 3;

    public const MAX = 60;

    /**
     * Segments the SPA routes itself under /courses/ and /teachers/, and
     * names that would mislead. Digits-only slugs are refused separately:
     * they would read as ids.
     */
    public const RESERVED = [
        'new', 'edit', 'tests', 'test', 'generate', 'assign', 'results', 'print', 'share', 'materials',
        'admin', 'api', 'login', 'logout', 'register', 'profile', 'settings', 'library', 'teachers', 'courses',
        'official', 'staff', 'support', 'help', 'moderator', 'null', 'undefined',
    ];

    /** Null when valid, else the reason, phrased for a form. */
    public static function problem(string $slug): ?string
    {
        if (mb_strlen($slug) < self::MIN || mb_strlen($slug) > self::MAX) {
            return 'Use '.self::MIN.' to '.self::MAX.' characters.';
        }
        if (! preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $slug)) {
            return 'Use lowercase letters, numbers and single hyphens, with no hyphen at either end.';
        }
        if (ctype_digit($slug)) {
            return 'Include at least one letter.';
        }
        if (in_array($slug, self::RESERVED, true)) {
            return 'That name is reserved.';
        }

        return null;
    }

    // ---- Reading ---------------------------------------------------------

    public static function handle(User $user): ?string
    {
        return UrlSlug::where('kind', SlugKind::Teacher)->where('user_id', $user->id)
            ->where('status', SlugStatus::Approved)->value('slug');
    }

    /** The teacher's newest handle row that is not retired (pending, approved or rejected). */
    public static function handleRequest(User $user): ?UrlSlug
    {
        return UrlSlug::where('kind', SlugKind::Teacher)->where('user_id', $user->id)
            ->where('status', '!=', SlugStatus::Retired)->latest('id')->first();
    }

    /** The course's current teacher_course row (pending or approved), its author's own. */
    public static function courseRequest(Course $course): ?UrlSlug
    {
        return UrlSlug::where('kind', SlugKind::TeacherCourse)->where('course_id', $course->id)
            ->where('scope_id', $course->user_id)
            ->whereIn('status', [SlugStatus::Pending, SlugStatus::Approved])->latest('id')->first();
    }

    public static function siteSlug(Course $course): ?string
    {
        return UrlSlug::where('kind', SlugKind::SiteCourse)->where('course_id', $course->id)
            ->where('status', SlugStatus::Approved)->value('slug');
    }

    public static function teacherPath(User $user): string
    {
        $handle = self::handle($user);

        return $handle !== null ? "/teachers/{$handle}" : "/teachers/{$user->id}";
    }

    public static function coursePath(Course $course): string
    {
        $site = self::siteSlug($course);
        if ($site !== null) {
            return "/courses/{$site}";
        }
        $own = self::courseRequest($course);
        if ($own !== null && $own->status === SlugStatus::Approved) {
            $handle = self::handle($course->author);
            if ($handle !== null) {
                return "/teachers/{$handle}/{$own->slug}";
            }
        }

        return "/courses/{$course->id}";
    }

    /**
     * Canonical paths for many courses at once (sitemap, PageHead), keyed by
     * course id. Same precedence as coursePath().
     *
     * @param  iterable<Course>  $courses
     * @return array<int, string>
     */
    public static function coursePaths(iterable $courses): array
    {
        $courses = collect($courses);
        $ids = $courses->pluck('id')->all();
        $site = UrlSlug::where('kind', SlugKind::SiteCourse)->where('status', SlugStatus::Approved)
            ->whereIn('course_id', $ids)->pluck('slug', 'course_id');
        $own = UrlSlug::where('kind', SlugKind::TeacherCourse)->where('status', SlugStatus::Approved)
            ->whereIn('course_id', $ids)->get(['course_id', 'scope_id', 'slug'])->keyBy('course_id');
        $handles = UrlSlug::where('kind', SlugKind::Teacher)->where('status', SlugStatus::Approved)
            ->whereIn('user_id', $courses->pluck('user_id')->unique()->all())->pluck('slug', 'user_id');

        $paths = [];
        foreach ($courses as $course) {
            $mine = $own->get($course->id);
            $paths[$course->id] = match (true) {
                isset($site[$course->id]) => "/courses/{$site[$course->id]}",
                $mine !== null && (int) $mine->scope_id === (int) $course->user_id && isset($handles[$course->user_id]) => "/teachers/{$handles[$course->user_id]}/{$mine->slug}",
                default => "/courses/{$course->id}",
            };
        }

        return $paths;
    }

    /** @param  iterable<int>  $userIds  @return array<int, string> keyed by user id */
    public static function teacherPaths(iterable $userIds): array
    {
        $ids = collect($userIds)->all();
        $handles = UrlSlug::where('kind', SlugKind::Teacher)->where('status', SlugStatus::Approved)
            ->whereIn('user_id', $ids)->pluck('slug', 'user_id');

        return collect($ids)->mapWithKeys(fn ($id) => [$id => isset($handles[$id]) ? "/teachers/{$handles[$id]}" : "/teachers/{$id}"])->all();
    }

    /**
     * A vanity path to what it names, for this viewer. Null for a path that
     * holds no slug, an unknown slug, or anything the viewer could not open
     * by id. `target` is the id path the SPA routes on; `canonical` is where
     * the address bar should end up (a retired slug's replacement).
     *
     * @return array{target: string, canonical: string}|null
     */
    public static function resolve(string $path, ?User $viewer): ?array
    {
        $seg = '([a-z0-9-]{1,'.self::MAX.'})';
        $tail = '(/tests/(\d{1,10}))?';

        if (preg_match("#^/courses/{$seg}{$tail}$#", $path, $m) && ! ctype_digit($m[1])) {
            $row = self::find(SlugKind::SiteCourse, 0, $m[1]);
            $course = $row?->course;

            return self::courseResult($course, $viewer, $m[3] ?? null);
        }

        if (preg_match("#^/teachers/{$seg}(/{$seg}{$tail})?$#", $path, $m) && ! ctype_digit($m[1])) {
            $user = self::find(SlugKind::Teacher, 0, $m[1])?->user;
            if ($user === null || ! $user->isActive() || ! $user->role->isPublic()) {
                return null;
            }
            if (! isset($m[3]) || $m[3] === '') {
                return ['target' => "/teachers/{$user->id}", 'canonical' => self::teacherPath($user)];
            }
            $course = self::find(SlugKind::TeacherCourse, $user->id, $m[3])?->course;
            if ($course === null || $course->user_id !== $user->id) {
                return null;
            }

            return self::courseResult($course, $viewer, $m[5] ?? null);
        }

        return null;
    }

    private static function find(SlugKind $kind, int $scope, string $slug): ?UrlSlug
    {
        return UrlSlug::where('kind', $kind)->where('scope_id', $scope)->where('slug', $slug)
            ->whereIn('status', SlugStatus::resolving())->first();
    }

    /** @return array{target: string, canonical: string}|null */
    private static function courseResult(?Course $course, ?User $viewer, ?string $testId): ?array
    {
        if ($course === null || ! CourseAccess::canView($viewer, $course)) {
            return null;
        }
        $suffix = ($testId !== null && $testId !== '') ? "/tests/{$testId}" : '';

        return ['target' => "/courses/{$course->id}{$suffix}", 'canonical' => self::coursePath($course).$suffix];
    }

    // ---- Writing ---------------------------------------------------------

    /**
     * A teacher asks for a handle: pending until an admin approves it. The
     * current approved handle keeps working meanwhile. Asking for the one
     * already approved, or already pending, changes nothing.
     */
    public static function requestHandle(User $user, string $slug): UrlSlug
    {
        self::assertValid($slug, 'handle');

        return DB::transaction(function () use ($user, $slug) {
            $existing = UrlSlug::where('kind', SlugKind::Teacher)->where('scope_id', 0)->where('slug', $slug)->lockForUpdate()->first();
            if ($existing !== null && $existing->user_id === $user->id && in_array($existing->status, [SlugStatus::Approved, SlugStatus::Pending], true)) {
                return $existing;
            }
            if ($existing !== null && ! ($existing->user_id === $user->id && $existing->status === SlugStatus::Retired)) {
                throw ValidationException::withMessages(['handle' => 'That handle is not available.']);
            }

            self::withdrawPendingHandle($user);
            if ($existing !== null) {
                // The teacher's own retired handle, asked for again.
                $existing->update(['status' => SlugStatus::Pending, 'reviewed_by' => null, 'reviewed_at' => null]);

                return $existing;
            }

            return UrlSlug::create(['kind' => SlugKind::Teacher, 'scope_id' => 0, 'slug' => $slug, 'user_id' => $user->id, 'status' => SlugStatus::Pending]);
        });
    }

    /** Drops a pending request; an approved handle and rejected names are untouched. */
    public static function withdrawPendingHandle(User $user): void
    {
        UrlSlug::where('kind', SlugKind::Teacher)->where('user_id', $user->id)
            ->where('status', SlugStatus::Pending)->delete();
    }

    /**
     * Approves a pending handle, retires the teacher's previous one, and
     * approves every course slug the teacher has waiting.
     */
    public static function approveHandle(UrlSlug $row, User $admin): void
    {
        abort_unless($row->kind === SlugKind::Teacher && $row->status === SlugStatus::Pending, 404);

        DB::transaction(function () use ($row, $admin) {
            UrlSlug::where('kind', SlugKind::Teacher)->where('user_id', $row->user_id)
                ->where('status', SlugStatus::Approved)->update(['status' => SlugStatus::Retired]);
            $row->update(['status' => SlugStatus::Approved, 'reviewed_by' => $admin->id, 'reviewed_at' => now()]);

            $waiting = UrlSlug::where('kind', SlugKind::TeacherCourse)->where('scope_id', $row->user_id)
                ->where('status', SlugStatus::Pending)->get();
            foreach ($waiting as $courseSlug) {
                self::approveCourseSlug($courseSlug);
            }
        });
    }

    /**
     * A rejected request stays on record so the same teacher cannot simply
     * resubmit it, and no one else can take a name an admin turned down.
     */
    public static function rejectHandle(UrlSlug $row, User $admin): void
    {
        abort_unless($row->kind === SlugKind::Teacher && $row->status === SlugStatus::Pending, 404);
        $row->update(['status' => SlugStatus::Rejected, 'reviewed_by' => $admin->id, 'reviewed_at' => now()]);
    }

    /**
     * The author names a course under their handle. Approved at once when
     * they have an approved handle, otherwise pending until they do. Null
     * clears it (an approved slug is retired, so old links still work).
     */
    public static function setCourseSlug(Course $course, ?string $slug): void
    {
        if ($slug !== null) {
            self::assertValid($slug, 'slug');
        }

        DB::transaction(function () use ($course, $slug) {
            $current = self::courseRequest($course);
            if ($current !== null && $current->slug === $slug) {
                return;
            }

            if ($slug !== null) {
                $existing = UrlSlug::where('kind', SlugKind::TeacherCourse)->where('scope_id', $course->user_id)
                    ->where('slug', $slug)->lockForUpdate()->first();
                // Only this course's own retired slug can come back.
                if ($existing !== null && ! ($existing->course_id === $course->id && $existing->status === SlugStatus::Retired)) {
                    throw ValidationException::withMessages(['slug' => 'You already use that name for another course.']);
                }
            }

            if ($current !== null) {
                $current->status === SlugStatus::Approved
                    ? $current->update(['status' => SlugStatus::Retired])
                    : $current->delete();
            }
            if ($slug === null) {
                return;
            }

            $row = $existing ?? new UrlSlug(['kind' => SlugKind::TeacherCourse, 'scope_id' => $course->user_id, 'slug' => $slug, 'user_id' => $course->user_id, 'course_id' => $course->id]);
            $row->status = SlugStatus::Pending;
            $row->save();
            if (self::handle($course->author) !== null) {
                self::approveCourseSlug($row);
            }
        });
    }

    /** An admin sets (or, with null, retires) a course's site-wide slug. */
    public static function setSiteSlug(Course $course, ?string $slug, User $admin): void
    {
        if ($slug !== null) {
            self::assertValid($slug, 'slug');
        }

        DB::transaction(function () use ($course, $slug, $admin) {
            $current = UrlSlug::where('kind', SlugKind::SiteCourse)->where('course_id', $course->id)
                ->where('status', SlugStatus::Approved)->first();
            if ($current?->slug === $slug) {
                return;
            }
            $existing = $slug === null ? null : UrlSlug::where('kind', SlugKind::SiteCourse)->where('scope_id', 0)
                ->where('slug', $slug)->lockForUpdate()->first();
            if ($existing !== null && $existing->course_id !== $course->id) {
                throw ValidationException::withMessages(['slug' => 'That address is taken (retired addresses are never reissued).']);
            }

            $current?->update(['status' => SlugStatus::Retired]);
            if ($slug === null) {
                return;
            }
            $row = $existing ?? new UrlSlug(['kind' => SlugKind::SiteCourse, 'scope_id' => 0, 'slug' => $slug, 'course_id' => $course->id]);
            $row->fill(['status' => SlugStatus::Approved, 'reviewed_by' => $admin->id, 'reviewed_at' => now()])->save();
        });
    }

    private static function approveCourseSlug(UrlSlug $row): void
    {
        UrlSlug::where('kind', SlugKind::TeacherCourse)->where('course_id', $row->course_id)
            ->where('status', SlugStatus::Approved)->where('id', '!=', $row->id)
            ->update(['status' => SlugStatus::Retired]);
        $row->update(['status' => SlugStatus::Approved, 'reviewed_at' => now()]);
    }

    private static function assertValid(string $slug, string $field): void
    {
        $problem = self::problem($slug);
        if ($problem !== null) {
            throw ValidationException::withMessages([$field => $problem]);
        }
    }
}
