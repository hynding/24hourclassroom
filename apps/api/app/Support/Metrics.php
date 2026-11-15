<?php

namespace App\Support;

use App\Models\Course;
use App\Models\Material;
use App\Models\Test;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * First-party, cookieless usage counts for the site owner (/admin/analytics).
 *
 * Everything is a daily counter in `daily_metrics`: (day, metric, dim) ->
 * count. Nothing that names or follows a person is stored: no IP, no user
 * id, no visitor id, no cookie, no full referrer URL, no query string. A
 * "visit" is the SPA saying "first page in this browser tab" (a per-tab
 * sessionStorage flag that never leaves the browser), so visits cannot be
 * linked across tabs, days or sites. Sign-ups are read from `users`.
 */
class Metrics
{
    public const VIEW = 'view';

    public const VISIT = 'visit';

    public const REFERRER = 'referrer';

    public const SOURCE = 'source';

    public const COURSE_VIEW = 'course_view';

    public const PRACTICE_CHECK = 'practice_check';

    public const BRANCH = 'branch';

    /** Crawlers, link-preview fetchers and headless browsers are not visitors. */
    private const BOT = '/bot|crawl|spider|slurp|preview|facebookexternalhit|headless|lighthouse|python|curl|wget|httpclient|java\//i';

    public static function bump(string $metric, string|int $dim = ''): void
    {
        $dim = mb_substr((string) $dim, 0, 191);
        DB::table('daily_metrics')->upsert(
            [['day' => now()->toDateString(), 'metric' => $metric, 'dim' => $dim, 'count' => 1]],
            ['day', 'metric', 'dim'],
            ['count' => DB::raw('count + 1')],
        );
    }

    public static function isBot(?string $userAgent): bool
    {
        return $userAgent === null || trim($userAgent) === '' || preg_match(self::BOT, $userAgent) === 1;
    }

    /** SPA routes with no id, counted as typed (services/router.ts). */
    private const STATIC = [
        '/', '/login', '/register', '/register/role', '/forgot-password', '/reset-password', '/verify-email',
        '/profile', '/connections', '/notifications', '/teachers', '/tests', '/tests/new', '/tests/generate',
        '/integrations', '/grading', '/materials', '/materials/new', '/courses', '/courses/new',
        '/library', '/library/tests', '/library/materials', '/library/courses',
    ];

    /** SPA routes with an id: counted by kind (`:id`) unless a guest could open the record. */
    private const KINDS = '#^/(tests/\d+(/(edit|assign|results|print))?|materials/\d+(/(edit|share))?|courses/\d+(/edit|/tests/\d+)?|attempts/\d+|generations/\d+|students/\d+|teachers/\d+)$#';

    /** Anything that is no SPA route, or no longer names anything, is counted here. */
    public const OTHER = '(other)';

    /**
     * The path as counted, and the course it shows. Only shapes the SPA
     * routes are kept, so nobody can fill the table with invented paths. A
     * page a guest can open (a public course, test, material or teacher)
     * is counted at its canonical address; any other id becomes `:id`, so
     * a private page is counted by kind, never by the record it shows.
     *
     * @return array{path: string, course: ?int}|null null for a malformed path
     */
    public static function classify(string $path): ?array
    {
        $path = '/'.trim(explode('?', explode('#', $path)[0])[0], '/');
        if (strlen($path) > 191 || ! preg_match('#^/[A-Za-z0-9/_.-]*$#', $path)) {
            return null;
        }
        if (in_array($path, self::STATIC, true)) {
            return ['path' => $path, 'course' => null];
        }

        // A vanity address: its canonical address, and the course it names.
        if (preg_match('#^/(courses|teachers)/[a-z0-9-]*[a-z-][a-z0-9-]*(/|$)#', $path)) {
            $resolved = Slugs::resolve($path, null);
            if ($resolved === null) {
                return ['path' => self::OTHER, 'course' => null];
            }
            $course = preg_match('#^/courses/(\d+)#', $resolved['target'], $m) ? (int) $m[1] : null;

            return ['path' => $resolved['canonical'], 'course' => $course];
        }

        if (! preg_match(self::KINDS, $path)) {
            return ['path' => self::OTHER, 'course' => null];
        }
        $kind = preg_replace('#/\d+(?=/|$)#', '/:id', $path);

        if (preg_match('#^/courses/(\d+)(/tests/(\d+))?$#', $path, $m)) {
            $course = Course::find((int) $m[1]);
            if ($course === null) {
                return ['path' => self::OTHER, 'course' => null];
            }
            if (! CourseAccess::canView(null, $course)) {
                return ['path' => $kind, 'course' => $course->id];
            }
            $test = isset($m[3]) ? Test::find((int) $m[3]) : null;
            $suffix = $test !== null && TestAccess::canView(null, $test) ? "/tests/{$test->id}" : (isset($m[3]) ? '/tests/:id' : '');

            return ['path' => Slugs::coursePath($course).$suffix, 'course' => $course->id];
        }
        if (preg_match('#^/teachers/(\d+)$#', $path, $m)) {
            $user = User::find((int) $m[1]);
            $public = $user !== null && $user->isActive() && $user->role->isPublic();

            return ['path' => $public ? Slugs::teacherPath($user) : $kind, 'course' => null];
        }
        if (preg_match('#^/tests/(\d+)$#', $path, $m)) {
            $test = Test::find((int) $m[1]);

            return ['path' => $test !== null && TestAccess::canView(null, $test) ? $path : $kind, 'course' => null];
        }
        if (preg_match('#^/materials/(\d+)$#', $path, $m)) {
            $material = Material::find((int) $m[1]);

            return ['path' => $material !== null && MaterialAccess::canView(null, $material) ? $path : $kind, 'course' => null];
        }

        return ['path' => $kind, 'course' => null];
    }

    /**
     * A free-text dimension (a referring site, a campaign) joins the day's
     * list only while that list is short; past the cap it counts as
     * `(other)`, so junk cannot grow the table or flood the admin page.
     */
    public static function bumpCapped(string $metric, string $dim, int $cap = 200): void
    {
        $day = now()->toDateString();
        $known = DB::table('daily_metrics')->where(['day' => $day, 'metric' => $metric, 'dim' => $dim])->exists();
        if (! $known && DB::table('daily_metrics')->where(['day' => $day, 'metric' => $metric])->count() >= $cap) {
            $dim = self::OTHER;
        }
        self::bump($metric, $dim);
    }

    /** Delete counters older than `$days` days. */
    public static function prune(int $days): int
    {
        return DB::table('daily_metrics')->where('day', '<', now()->subDays($days)->toDateString())->delete();
    }

    /** A referring site's host, without `www.`; null for this site or no referrer. */
    public static function referrerHost(?string $referrer, string $ownHost): ?string
    {
        $host = is_string($referrer) ? parse_url($referrer, PHP_URL_HOST) : null;
        if (! is_string($host) || $host === '') {
            return null;
        }
        $host = strtolower(preg_replace('/^www\./i', '', $host));
        $own = strtolower(preg_replace('/^www\./i', '', $ownHost));

        return ($host === $own || str_ends_with($host, '.'.$own)) ? null : mb_substr($host, 0, 191);
    }
}
