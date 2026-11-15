<?php

use App\Enums\SlugKind;
use App\Enums\SlugStatus;
use App\Models\Question;
use App\Models\Test;
use App\Models\UrlSlug;
use App\Models\User;
use App\Support\Metrics;
use Illuminate\Support\Facades\DB;

const ANALYTICS_BROWSER_UA = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 14_0) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Safari/605.1.15';

beforeEach(function () {
    config(['app.frontend_urls' => 'https://24hourclassroom.test']);
});

function metricCounts(string $metric): array
{
    return DB::table('daily_metrics')->where('metric', $metric)->pluck('count', 'dim')->map(fn ($c) => (int) $c)->all();
}

function countView(array $body, string $ua = ANALYTICS_BROWSER_UA)
{
    return test()->withHeader('User-Agent', $ua)->postJson('/api/analytics/view', $body);
}

test('a page view is counted by path and day, with nothing that names the visitor', function () {
    countView(['path' => '/library/courses'])->assertNoContent();
    countView(['path' => '/library/courses/'])->assertNoContent();

    expect(metricCounts(Metrics::VIEW))->toBe(['/library/courses' => 2])
        ->and(DB::table('daily_metrics')->first())->toHaveKeys(['day', 'metric', 'dim', 'count'])
        ->and(array_keys((array) DB::table('daily_metrics')->first()))->toBe(['id', 'day', 'metric', 'dim', 'count']);
});

test('a visit records its referring site and campaign, never the full address, and never this site', function () {
    countView(['path' => '/', 'visit' => true, 'referrer' => 'https://www.Reddit.com/r/APbio/comments/abc?user=x', 'source' => 'APBio-Group']);
    countView(['path' => '/', 'visit' => true, 'referrer' => 'https://24hourclassroom.test/courses/1']);
    countView(['path' => '/', 'visit' => true, 'referrer' => 'https://api.24hourclassroom.test/x', 'source' => 'bad source!']);

    expect(metricCounts(Metrics::VISIT))->toBe(['' => 3])
        ->and(metricCounts(Metrics::REFERRER))->toBe(['reddit.com' => 1])
        ->and(metricCounts(Metrics::SOURCE))->toBe(['apbio-group' => 1]);
});

test('only SPA routes are kept: private records by kind, public ones at their canonical address', function () {
    $author = aTeacher();
    $public = Test::factory()->for($author, 'author')->published()->create();
    $private = Test::factory()->for($author, 'author')->create();
    $hidden = aCourse($author);
    foreach (['/attempts/41', '/attempts/42', "/tests/{$public->id}/edit", '/students/3', "/tests/{$public->id}", "/tests/{$private->id}", "/courses/{$hidden->id}", '/wp-admin.php', '/courses/12345', '/teachers/no-such-handle', '/teachers/999999'] as $path) {
        countView(['path' => $path]);
    }

    expect(metricCounts(Metrics::VIEW))->toEqual([
        '/attempts/:id' => 2, '/tests/:id/edit' => 1, '/students/:id' => 1, "/tests/{$public->id}" => 1, '/tests/:id' => 1,
        '/courses/:id' => 1, Metrics::OTHER => 3, '/teachers/:id' => 1,
    ])->and(metricCounts(Metrics::COURSE_VIEW))->toBe([(string) $hidden->id => 1]);
});

test('the SPA\'s own cross-site request is counted and writes no session', function () {
    config(['session.driver' => 'database']);
    $this->withHeaders(['Origin' => 'http://localhost:3333', 'Referer' => 'http://localhost:3333/library'])
        ->withHeader('User-Agent', ANALYTICS_BROWSER_UA)
        ->postJson('/api/analytics/view', ['path' => '/library'])->assertNoContent();

    expect(metricCounts(Metrics::VIEW))->toBe(['/library' => 1])
        ->and(DB::table('sessions')->count())->toBe(0);
});

test('referring sites and campaigns past the day\'s cap count as other, and old counters can be pruned', function () {
    foreach (range(1, 200) as $i) {
        DB::table('daily_metrics')->insert(['day' => now()->toDateString(), 'metric' => Metrics::REFERRER, 'dim' => "site{$i}.example", 'count' => 1]);
    }
    Metrics::bumpCapped(Metrics::REFERRER, 'site7.example');
    Metrics::bumpCapped(Metrics::REFERRER, 'new.example');

    expect(metricCounts(Metrics::REFERRER))->toHaveKey(Metrics::OTHER, 1)->not->toHaveKey('new.example')
        ->and(metricCounts(Metrics::REFERRER)['site7.example'])->toBe(2);

    DB::table('daily_metrics')->insert(['day' => now()->subDays(500)->toDateString(), 'metric' => Metrics::VIEW, 'dim' => '/', 'count' => 9]);
    $this->artisan('analytics:prune')->assertSuccessful();
    expect(DB::table('daily_metrics')->where('day', '<', now()->subDays(400)->toDateString())->count())->toBe(0);
});

test('bots, junk and query strings are not counted', function () {
    countView(['path' => '/'], 'Googlebot/2.1 (+http://www.google.com/bot.html)')->assertNoContent();
    countView(['path' => '/'], 'facebookexternalhit/1.1')->assertNoContent();
    countView(['path' => '/'], '')->assertNoContent();
    countView(['path' => 'javascript:alert(1)'])->assertNoContent();
    countView(['path' => ['/']])->assertNoContent();
    countView(['path' => '/reset-password?token=secret']);

    expect(metricCounts(Metrics::VIEW))->toBe(['/reset-password' => 1]);
});

test('a public course is counted at its canonical address, by id, however it was opened', function () {
    $author = aTeacher();
    $test = Test::factory()->for($author, 'author')->published()->create();
    $course = aCourse($author, [$test], ['visibility' => 'public', 'published_at' => now()]);
    UrlSlug::create(['kind' => SlugKind::SiteCourse, 'scope_id' => 0, 'slug' => 'ap-biology', 'course_id' => $course->id, 'status' => SlugStatus::Approved, 'reviewed_at' => now()]);

    countView(['path' => "/courses/{$course->id}"]);
    countView(['path' => '/courses/ap-biology']);
    countView(['path' => "/courses/{$course->id}/tests/{$test->id}"]);
    countView(['path' => '/courses/nothing-here']);

    expect(metricCounts(Metrics::COURSE_VIEW))->toBe([(string) $course->id => 3])
        ->and(metricCounts(Metrics::VIEW))->toEqual(['/courses/ap-biology' => 2, "/courses/ap-biology/tests/{$test->id}" => 1, Metrics::OTHER => 1]);
});

test('a deleted course keeps its counters and the admin page still opens', function () {
    $course = aCourse(aTeacher());
    Metrics::bump(Metrics::COURSE_VIEW, $course->id);
    $course->delete();

    $this->actingAs(User::factory()->create(['role' => 'admin']))->get('/admin/analytics')->assertOk()
        ->assertInertia(fn ($page) => $page->where('courses.0.title', 'Deleted course'));
});

test('a checked practice run and a branch are counted per course', function () {
    $author = aTeacher();
    $test = Test::factory()->for($author, 'author')->published()->create();
    Question::factory()->for($test)->create(['position' => 0, 'answer' => 1]);
    $course = aCourse($author, [$test], ['visibility' => 'public', 'published_at' => now()]);

    $this->withHeader('Referer', 'http://localhost:3333')
        ->postJson("/api/courses/{$course->id}/tests/{$test->id}/check", ['responses' => []])->assertOk();
    $this->actingAs(aTeacher())->postJson("/api/courses/{$course->id}/branch")->assertCreated();

    expect(metricCounts(Metrics::PRACTICE_CHECK))->toBe([(string) $course->id => 1])
        ->and(metricCounts(Metrics::BRANCH))->toBe([(string) $course->id => 1]);
});

test('only an admin sees /admin/analytics, with totals, courses and sign-ups', function () {
    $author = aTeacher(['name' => 'Ms K']);
    $course = aCourse($author, [], ['title' => 'Biology', 'visibility' => 'public', 'published_at' => now()]);
    Metrics::bump(Metrics::VIEW, '/');
    Metrics::bump(Metrics::VIEW, '/');
    Metrics::bump(Metrics::VISIT);
    Metrics::bump(Metrics::COURSE_VIEW, $course->id);
    Metrics::bump(Metrics::PRACTICE_CHECK, $course->id);
    Metrics::bump(Metrics::REFERRER, 'reddit.com');

    $this->actingAs($author)->get('/admin/analytics')->assertForbidden();

    $admin = User::factory()->create(['role' => 'admin']);
    $this->actingAs($admin)->get('/admin/analytics?days=7')->assertOk()->assertInertia(fn ($page) => $page
        ->component('admin/analytics')
        ->where('days', 7)
        ->where('totals.views', 2)
        ->where('totals.visits', 1)
        ->where('totals.signups', 1)
        ->where('totals.practice_checks', 1)
        ->has('daily', 7)
        ->where('daily.6.views', 2)
        ->where('pages.0', ['key' => '/', 'count' => 2])
        ->where('referrers.0', ['key' => 'reddit.com', 'count' => 1])
        ->where('signups_by_role.0', ['key' => 'teacher', 'count' => 1])
        ->where('courses.0.title', 'Biology')
        ->where('courses.0.author', 'Ms K')
        ->where('courses.0.views', 1)
        ->where('courses.0.practice_checks', 1));
});
