<?php

namespace App\Http\Controllers\Api;

use App\Enums\Role;
use App\Enums\Visibility;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseItem;
use App\Models\Material;
use App\Models\Test;
use App\Models\User;
use App\Support\FrontendRedirect;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

/**
 * sitemap.xml for the SPA: every page a logged-out visitor can open, with
 * SPA-origin URLs. Served from the API host because only the API can see
 * the database; the SPA's robots.txt points crawlers here (a cross-host
 * sitemap is valid when the site's own robots.txt names it).
 *
 * Each query is the guest branch of its *Access::canView rule in SQL --
 * public, author active -- so nothing a visitor would 404 on is listed.
 * Change them together.
 */
class SitemapController extends Controller
{
    /** The protocol's per-file limit; past it this needs a sitemap index. */
    private const MAX_URLS = 50000;

    /** Listings and directories: always present, no lastmod. */
    private const STATIC_PATHS = ['/', '/library', '/library/courses', '/library/tests', '/library/materials', '/teachers'];

    public function __invoke(): Response
    {
        $origin = FrontendRedirect::spaOrigin();
        $active = fn ($q) => $q->whereNull('deactivated_at');

        $entries = array_map(fn (string $path) => [$path, null], self::STATIC_PATHS);

        $courses = Course::query()
            ->where('visibility', Visibility::Public)
            ->whereHas('author', $active)
            ->orderBy('id')
            ->get(['id', 'user_id', 'updated_at']);
        foreach ($courses as $course) {
            $entries[] = ["/courses/{$course->id}", $course->updated_at];
        }

        // Practice mode: CourseAccess::canPractice for a guest -- the course
        // is public with an active author (filtered above), and the test is
        // the course author's own and itself public.
        $practice = CourseItem::query()
            ->whereIn('course_id', $courses->pluck('id'))
            ->join('courses', 'courses.id', '=', 'course_items.course_id')
            ->join('tests', 'tests.id', '=', 'course_items.test_id')
            ->whereColumn('tests.user_id', 'courses.user_id')
            ->where('tests.visibility', Visibility::Public)
            ->orderBy('course_items.course_id')
            ->orderBy('course_items.position')
            ->get(['course_items.course_id', 'course_items.test_id', 'tests.updated_at']);
        foreach ($practice as $item) {
            $entries[] = ["/courses/{$item->course_id}/tests/{$item->test_id}", Carbon::parse($item->updated_at)];
        }

        foreach ([Test::class => '/tests/', Material::class => '/materials/'] as $model => $prefix) {
            $rows = $model::query()
                ->where('visibility', Visibility::Public)
                ->whereHas('author', $active)
                ->orderBy('id')
                ->get(['id', 'updated_at']);
            foreach ($rows as $row) {
                $entries[] = [$prefix.$row->id, $row->updated_at];
            }
        }

        // PublicProfileController: only Role::isPublic() profiles are public.
        $teachers = User::query()
            ->whereIn('role', Role::publicValues())
            ->tap($active)
            ->orderBy('id')
            ->get(['id', 'updated_at']);
        foreach ($teachers as $teacher) {
            $entries[] = ["/teachers/{$teacher->id}", $teacher->updated_at];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n"
            .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
        foreach (array_slice($entries, 0, self::MAX_URLS) as [$path, $modified]) {
            $xml .= '  <url><loc>'.htmlspecialchars($origin.$path, ENT_XML1).'</loc>'
                .($modified ? '<lastmod>'.$modified->toAtomString().'</lastmod>' : '')
                ."</url>\n";
        }
        $xml .= "</urlset>\n";

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
