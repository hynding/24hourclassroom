<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Support\FrontendRedirect;
use App\Support\Metrics;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

/**
 * /admin/analytics: the site's usage counters (App\Support\Metrics) and
 * sign-ups (from `users`) over the last 7, 30 or 90 days. Everything shown
 * is an aggregate; no row names a visitor.
 */
class AnalyticsAdminController extends Controller
{
    private const RANGES = [7, 30, 90];

    public function index(Request $request): Response
    {
        $days = in_array((int) $request->query('days'), self::RANGES, true) ? (int) $request->query('days') : 30;
        $today = CarbonImmutable::today();
        $from = $today->subDays($days - 1);

        $metrics = fn (string $metric) => DB::table('daily_metrics')
            ->where('metric', $metric)->whereBetween('day', [$from->toDateString(), $today->toDateString()]);
        $top = fn (string $metric, int $limit) => $metrics($metric)
            ->groupBy('dim')->selectRaw('dim, SUM(count) as total')->orderByDesc('total')->orderBy('dim')->limit($limit)
            ->get()->map(fn ($r) => ['key' => $r->dim, 'count' => (int) $r->total])->all();
        $byDay = fn (string $metric) => $metrics($metric)->groupBy('day')->selectRaw('day, SUM(count) as total')->pluck('total', 'day');

        $signups = User::query()->whereIn('role', Role::selfAssignableValues())
            ->where('created_at', '>=', $from->startOfDay());
        $signupsByDay = (clone $signups)->selectRaw('DATE(created_at) as day, COUNT(*) as total')->groupBy('day')->pluck('total', 'day');

        $views = $byDay(Metrics::VIEW);
        $visits = $byDay(Metrics::VISIT);
        $daily = [];
        for ($d = $from; $d->lte($today); $d = $d->addDay()) {
            $key = $d->toDateString();
            $daily[] = ['day' => $key, 'views' => (int) ($views[$key] ?? 0), 'visits' => (int) ($visits[$key] ?? 0), 'signups' => (int) ($signupsByDay[$key] ?? 0)];
        }

        return Inertia::render('admin/analytics', [
            'days' => $days,
            'ranges' => self::RANGES,
            'spa_origin' => FrontendRedirect::spaOrigin(),
            'totals' => [
                'views' => (int) $metrics(Metrics::VIEW)->sum('count'),
                'visits' => (int) $metrics(Metrics::VISIT)->sum('count'),
                'signups' => (clone $signups)->count(),
                'practice_checks' => (int) $metrics(Metrics::PRACTICE_CHECK)->sum('count'),
                'branches' => (int) $metrics(Metrics::BRANCH)->sum('count'),
            ],
            'daily' => $daily,
            'pages' => $top(Metrics::VIEW, 25),
            'referrers' => $top(Metrics::REFERRER, 15),
            'sources' => $top(Metrics::SOURCE, 15),
            'signups_by_role' => (clone $signups)->selectRaw('role, COUNT(*) as total')->groupBy('role')->orderByDesc('total')
                ->get()->map(fn ($r) => ['key' => $r->role instanceof Role ? $r->role->value : (string) $r->role, 'count' => (int) $r->total])->all(),
            'courses' => $this->courses($metrics),
        ]);
    }

    /**
     * Per course: page views (any of its addresses), finished practice runs
     * and branches, the 25 most viewed first.
     *
     * @param  callable(string): \Illuminate\Database\Query\Builder  $metrics
     * @return list<array<string, mixed>>
     */
    private function courses(callable $metrics): array
    {
        /** @var Collection<string, array<string, int>> $rows */
        $rows = collect();
        foreach ([Metrics::COURSE_VIEW => 'views', Metrics::PRACTICE_CHECK => 'practice_checks', Metrics::BRANCH => 'branches'] as $metric => $field) {
            foreach ($metrics($metric)->groupBy('dim')->selectRaw('dim, SUM(count) as total')->get() as $r) {
                $rows[$r->dim] = [...($rows[$r->dim] ?? ['views' => 0, 'practice_checks' => 0, 'branches' => 0]), $field => (int) $r->total];
            }
        }
        $rows = $rows->sortByDesc(fn ($r) => [$r['views'], $r['practice_checks']])->take(25);
        $courses = Course::query()->with('author:id,name')->whereIn('id', $rows->keys()->map(fn ($k) => (int) $k))->get()->keyBy('id');

        return $rows->map(fn ($r, $id) => [
            'id' => (int) $id,
            // A course deleted since keeps its counters until they are pruned.
            'title' => $courses->get((int) $id)?->title ?? 'Deleted course',
            'author' => $courses->get((int) $id)?->author?->name,
            'public' => (bool) $courses->get((int) $id)?->isPublic(),
        ] + $r)->values()->all();
    }
}
