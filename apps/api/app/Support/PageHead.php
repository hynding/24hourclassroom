<?php

namespace App\Support;

use App\Models\Course;
use App\Models\Material;
use App\Models\SiteSetting;
use App\Models\Test;
use App\Models\User;
use BackedEnum;

/**
 * The server-rendered <head> of a public SPA page, for link-preview bots
 * (iMessage, Discord, Slack, Facebook...) that never run JavaScript.
 *
 * The SPA host's index.php asks GET /api/page-head?path=... and splices the
 * returned fragment into index.html; the SPA's own page-meta.ts then takes
 * the same tags over after load. Keep the two describing a page the same
 * way: titles, fallback descriptions and JSON-LD here mirror page-meta.ts.
 *
 * Always the GUEST view: a page a logged-out visitor would 404 on gets the
 * site-wide head and noindex, never its title -- a preview must not leak a
 * private course's name.
 */
final class PageHead
{
    private const DESCRIPTION_MAX = 160;

    /** page-meta.ts LISTING_TITLES; null = the site name alone. */
    private const LISTINGS = [
        '/' => null,
        '/library' => 'Library',
        '/library/courses' => 'Free courses',
        '/library/tests' => 'Practice tests',
        '/library/materials' => 'Study materials',
        '/teachers' => 'Teachers',
    ];

    private string $origin;

    private string $siteName;

    private ?string $tagline;

    public function __construct()
    {
        $this->origin = FrontendRedirect::spaOrigin();
        $site = SiteSetting::current();
        $this->siteName = (string) $site->name;
        $this->tagline = $site->tagline;
    }

    /**
     * Null when the path is not a page this describes (the caller serves
     * index.html untouched).
     *
     * @return array{title: ?string, description: ?string, indexable: bool, type: string, path: string, json_ld: ?array<string, mixed>, card: array{kicker: string, detail: ?string}}|null
     */
    public function resolve(string $path): ?array
    {
        if (array_key_exists($path, self::LISTINGS)) {
            return $this->meta($path, self::LISTINGS[$path], null, true, 'website', null, 'Browse', self::summarize($this->tagline, 140));
        }

        // A vanity path describes what it names, at its canonical address.
        $slug = Slugs::resolve($path, null);
        if ($slug !== null) {
            return $this->resolve($slug['target']);
        }

        if (preg_match('#^/courses/(\d{1,10})/tests/(\d{1,10})$#', $path, $m)) {
            return $this->practice((int) $m[1], (int) $m[2]) ?? $this->hidden($path);
        }
        if (preg_match('#^/(courses|tests|materials|teachers)/(\d{1,10})$#', $path, $m)) {
            $id = (int) $m[2];
            $meta = match ($m[1]) {
                'courses' => $this->course($id),
                'tests' => $this->test($id),
                'materials' => $this->material($id),
                'teachers' => $this->teacher($id),
            };

            return $meta ?? $this->hidden($path);
        }

        return null;
    }

    /** The fragment index.php puts in <head>; every value escaped here. */
    public function html(array $meta): string
    {
        $title = $meta['title'] !== null ? "{$meta['title']} · {$this->siteName}" : $this->siteName;
        $description = self::summarize($meta['description']) ?? self::summarize($this->tagline);
        $url = $this->origin.$meta['path'];

        $tags = ['<title>'.e($title).'</title>'];
        if ($description !== null) {
            $tags[] = $this->tag('meta', 'name', 'description', $description);
        }
        if ($meta['indexable']) {
            $tags[] = $this->tag('link', 'rel', 'canonical', $url);
        } else {
            $tags[] = $this->tag('meta', 'name', 'robots', 'noindex');
        }
        $tags[] = $this->tag('meta', 'property', 'og:title', $meta['title'] ?? $this->siteName);
        if ($description !== null) {
            $tags[] = $this->tag('meta', 'property', 'og:description', $description);
        }
        $tags[] = $this->tag('meta', 'property', 'og:type', $meta['type']);
        $tags[] = $this->tag('meta', 'property', 'og:url', $url);
        $tags[] = $this->tag('meta', 'property', 'og:site_name', $this->siteName);
        $tags[] = $this->tag('meta', 'property', 'og:image', self::imageUrl($meta['path'], $this->card($meta)));
        $tags[] = $this->tag('meta', 'property', 'og:image:width', (string) ShareCard::WIDTH);
        $tags[] = $this->tag('meta', 'property', 'og:image:height', (string) ShareCard::HEIGHT);
        $tags[] = $this->tag('meta', 'property', 'og:image:alt', $meta['title'] ?? $this->siteName);
        $tags[] = $this->tag('meta', 'name', 'twitter:card', 'summary_large_image');

        if ($meta['json_ld'] !== null && $meta['indexable']) {
            // JSON_HEX_TAG turns every < and > into < / >, so
            // author-written text cannot close the script element.
            $json = json_encode(
                ['@context' => 'https://schema.org'] + $meta['json_ld'],
                JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR,
            );
            $tags[] = '<script type="application/ld+json" id="page-json-ld">'.$json.'</script>';
        }

        return implode("\n    ", $tags);
    }

    /** page-meta.ts summarize(): whitespace collapsed, cut at a word with an ellipsis. */
    public static function summarize(?string $text, int $max = self::DESCRIPTION_MAX): ?string
    {
        $flat = trim((string) preg_replace('/\s+/u', ' ', (string) $text));
        if ($flat === '') {
            return null;
        }
        if (mb_strlen($flat) <= $max) {
            return $flat;
        }
        $cut = mb_substr($flat, 0, $max - 1);
        $space = mb_strrpos($cut, ' ');
        $kept = ($space !== false && $space > $max / 2) ? mb_substr($cut, 0, $space) : $cut;

        return rtrim($kept, " \t.,;:").'…';
    }

    private function tag(string $tag, string $key, string $keyValue, string $value): string
    {
        $attr = $tag === 'link' ? 'href' : 'content';

        // data-page-meta: page-meta.ts adopts these instead of adding twins.
        return "<{$tag} {$key}=\"".e($keyValue)."\" {$attr}=\"".e($value).'" data-page-meta>';
    }

    /** @return array{title: ?string, description: ?string, indexable: bool, type: string, path: string, json_ld: ?array<string, mixed>, card: array{kicker: string, detail: ?string}} */
    private function meta(string $path, ?string $title, ?string $description, bool $indexable, string $type = 'website', ?array $jsonLd = null, string $kicker = '', ?string $detail = null): array
    {
        return ['title' => $title, 'description' => $description, 'indexable' => $indexable, 'type' => $type, 'path' => $path, 'json_ld' => $jsonLd, 'card' => ['kicker' => $kicker, 'detail' => $detail]];
    }

    /**
     * What the share card (og:image, ShareCard) draws for a page: never more
     * than its head already says, so a hidden page gets the site's own card.
     *
     * @param  array{title: ?string, card: array{kicker: string, detail: ?string}}  $meta
     * @return array{kicker: string, title: string, detail: ?string, site: string, host: string, is_site: bool}
     */
    public function card(array $meta): array
    {
        // A title the fonts can't draw would leave a blank card (ShareCard::covers):
        // the site's own card instead; an undrawable detail is left off.
        $isSite = $meta['title'] === null || ! ShareCard::covers($meta['title']);
        $detail = $isSite ? self::summarize($this->tagline, 140) : $meta['card']['detail'];

        return [
            'kicker' => $isSite ? 'Free courses, tests and study materials' : $meta['card']['kicker'],
            'title' => $isSite ? $this->siteName : $meta['title'],
            'detail' => $detail !== null && ShareCard::covers($detail) ? $detail : null,
            'site' => $this->siteName,
            'host' => (string) parse_url($this->origin, PHP_URL_HOST),
            'is_site' => $isSite,
        ];
    }

    /**
     * The og:image URL for a page: the API's own share-card route. `v`, a
     * hash of what the card draws, changes the URL whenever the card does,
     * because preview bots cache images by URL; the route ignores it. The
     * site's card has one hash, so `v` says nothing about a hidden page.
     *
     * @param  array<string, mixed>|null  $card  PageHead::card() for the page
     */
    public static function imageUrl(string $path, ?array $card = null): string
    {
        $url = rtrim((string) config('app.url'), '/').'/api/page-image?path='.rawurlencode($path);

        return $card === null ? $url : $url.'&v='.self::cardHash($card);
    }

    /** @param  array<string, mixed>  $card */
    public static function cardHash(array $card): string
    {
        return substr(sha1(ShareCard::VERSION.json_encode($card, JSON_THROW_ON_ERROR)), 0, 12);
    }

    /** A page a guest cannot open: the site's own head, kept out of the index. */
    private function hidden(string $path): array
    {
        return $this->meta($path, null, null, false);
    }

    private function course(int $id): ?array
    {
        $course = Course::with(['author', 'items.test.author', 'items.material.author'])->find($id);
        if ($course === null || ! CourseAccess::canView(null, $course)) {
            return null;
        }
        $items = $course->items->filter(fn ($item) => CourseAccess::showsItem(null, $course, $item));
        $tests = $items->whereNotNull('test_id')->count();
        $materials = $items->whereNotNull('material_id')->count();
        $path = Slugs::coursePath($course);
        $description = self::summarize($course->description)
            ?? 'A free '.self::label(TaxonomyLabels::subjects(), $course->subject)." course by {$course->author->name}: {$tests} practice tests and {$materials} study materials.";

        return $this->meta($path, $course->title, $description, true, 'website', [
            '@type' => 'Course',
            'name' => $course->title,
            'description' => $description,
            'url' => $this->origin.$path,
            'author' => $this->person($course->author),
            'provider' => ['@type' => 'Organization', 'name' => $this->siteName, 'url' => $this->origin],
            'isAccessibleForFree' => true,
        ] + $this->topics($course), 'Free course', self::count($tests, 'practice test').' · '.self::count($materials, 'study material', 'study materials')." · by {$course->author->name}");
    }

    private function practice(int $courseId, int $testId): ?array
    {
        $course = Course::with('author')->find($courseId);
        $test = Test::with('author')->withCount('questions')->find($testId);
        if ($course === null || $test === null || ! CourseAccess::canPractice(null, $course, $test)) {
            return null;
        }
        $coursePath = Slugs::coursePath($course);
        $path = "{$coursePath}/tests/{$test->id}";
        $description = self::summarize($test->description)
            ?? "Practise {$test->questions_count} questions with answers and explanations, from {$course->title}.";

        return $this->meta($path, "{$test->title} (practice)", $description, true, 'article', [
            '@type' => 'Quiz',
            'name' => $test->title,
            'description' => $description,
            'url' => $this->origin.$path,
            'author' => $this->person($test->author),
            'isAccessibleForFree' => true,
            'isPartOf' => ['@type' => 'Course', 'name' => $course->title, 'url' => $this->origin.$coursePath],
        ] + $this->topics($test), 'Practice test', self::count($test->questions_count, 'question')." with answers · from {$course->title}");
    }

    private function test(int $id): ?array
    {
        $test = Test::with('author')->withCount('questions')->find($id);
        if ($test === null || ! TestAccess::canView(null, $test)) {
            return null;
        }
        $path = "/tests/{$test->id}";
        $description = self::summarize($test->description)
            ?? "A {$test->questions_count}-question ".self::label(TaxonomyLabels::subjects(), $test->subject)." test by {$test->author->name}.";

        return $this->meta($path, $test->title, $description, true, 'article', [
            '@type' => 'Quiz',
            'name' => $test->title,
            'description' => $description,
            'url' => $this->origin.$path,
            'author' => $this->person($test->author),
            'isAccessibleForFree' => true,
        ] + $this->topics($test), self::label(TaxonomyLabels::subjects(), $test->subject).' test', self::count($test->questions_count, 'question')." · by {$test->author->name}");
    }

    private function material(int $id): ?array
    {
        $material = Material::with('author')->find($id);
        if ($material === null || ! MaterialAccess::canView(null, $material)) {
            return null;
        }
        $path = "/materials/{$material->id}";
        $description = self::summarize($material->description)
            ?? self::label(TaxonomyLabels::subjects(), $material->subject)." study material by {$material->author->name}.";

        return $this->meta($path, $material->title, $description, true, 'article', [
            '@type' => 'LearningResource',
            'name' => $material->title,
            'description' => $description,
            'url' => $this->origin.$path,
            'author' => $this->person($material->author),
            'encodingFormat' => $material->mime_type,
            'isAccessibleForFree' => true,
        ] + $this->topics($material), self::label(TaxonomyLabels::subjects(), $material->subject).' study material', "by {$material->author->name}");
    }

    /** PublicProfileController's guest branch: an active Role::isPublic() user only. */
    private function teacher(int $id): ?array
    {
        $user = User::with('profile')->find($id);
        if ($user === null || ! $user->isActive() || ! $user->role->isPublic()) {
            return null;
        }
        $path = Slugs::teacherPath($user);
        $school = $user->profile?->school;
        $description = self::summarize($user->profile?->bio)
            ?? $user->name.($school ? " ({$school})" : '').' shares tests, study materials and courses.';
        $person = ['@type' => 'Person', 'name' => $user->name, 'url' => $this->origin.$path];
        if ($school) {
            $person['affiliation'] = ['@type' => 'EducationalOrganization', 'name' => $school];
        }

        return $this->meta($path, $user->name, $description, true, 'profile', ['@type' => 'ProfilePage', 'mainEntity' => $person], 'Teacher', $school ?: 'Tests, study materials and courses');
    }

    private static function count(int $n, string $one, ?string $many = null): string
    {
        return $n.' '.($n === 1 ? $one : ($many ?? "{$one}s"));
    }

    /** @return array<string, string> */
    private function person(User $author): array
    {
        return ['@type' => 'Person', 'name' => $author->name, 'url' => "{$this->origin}/teachers/{$author->id}"];
    }

    /** @return array{about: string, educationalLevel: string} */
    private function topics(Course|Test|Material $item): array
    {
        return [
            'about' => self::label(TaxonomyLabels::subjects(), $item->subject),
            'educationalLevel' => self::label(TaxonomyLabels::gradeLevels(), $item->grade_level),
        ];
    }

    /** @param array<int, array{value: string, label: string}> $list */
    private static function label(array $list, BackedEnum|string|null $value): string
    {
        $raw = $value instanceof BackedEnum ? (string) $value->value : (string) $value;
        foreach ($list as $option) {
            if ($option['value'] === $raw) {
                return $option['label'];
            }
        }

        return $raw;
    }
}
