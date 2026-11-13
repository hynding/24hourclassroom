<?php

use App\Enums\Role;
use App\Models\Material;
use App\Models\SiteSetting;
use App\Models\Test;
use App\Models\User;

beforeEach(function () {
    config(['app.frontend_urls' => 'https://classroom.test']);
});

function pageHead($test, string $path): string
{
    return $test->getJson('/api/page-head?path='.rawurlencode($path))->assertOk()->json('head');
}

test('a public course gets its own title, description, canonical and Course JSON-LD', function () {
    $author = aTeacher(['name' => 'Ada Lovelace']);
    $test = Test::factory()->for($author, 'author')->published()->create();
    $course = aCourse($author, [$test], ['visibility' => 'public', 'published_at' => now(), 'title' => 'Engines', 'description' => 'All about   engines.']);

    $head = pageHead($this, "/courses/{$course->id}");
    $site = SiteSetting::current()->name;

    expect($head)->toContain('<title>Engines · '.e($site).'</title>')
        ->toContain('<meta name="description" content="All about engines." data-page-meta>')
        ->toContain("<link rel=\"canonical\" href=\"https://classroom.test/courses/{$course->id}\" data-page-meta>")
        ->toContain('<meta property="og:title" content="Engines" data-page-meta>')
        ->toContain('"@type":"Course"')
        ->toContain('"name":"Ada Lovelace"')
        ->not->toContain('noindex');
});

test('a private course, a missing one and a deactivated author\'s look the same: site head, noindex', function () {
    $author = aTeacher();
    $private = aCourse($author, [], ['title' => 'Secret plans']);
    $gone = aTeacher(['deactivated_at' => now()]);
    $hidden = aCourse($gone, [], ['visibility' => 'public', 'published_at' => now(), 'title' => 'Hidden away']);

    foreach (["/courses/{$private->id}", "/courses/{$hidden->id}", '/courses/999999'] as $path) {
        $head = pageHead($this, $path);
        expect($head)->toContain('<meta name="robots" content="noindex" data-page-meta>')
            ->not->toContain('Secret plans')
            ->not->toContain('Hidden away')
            ->not->toContain('canonical')
            ->not->toContain('ld+json');
    }
});

test('author-written text is escaped in tags and cannot close the JSON-LD script', function () {
    $author = aTeacher();
    $test = Test::factory()->for($author, 'author')->published()->create([
        'title' => '"><script>alert(1)</script>',
        'description' => 'Ends </script><b>here</b> & more',
    ]);

    $head = pageHead($this, "/tests/{$test->id}");

    expect($head)->not->toContain('<script>alert(1)')
        ->not->toContain('</script><b>')
        ->toContain('&quot;&gt;&lt;script&gt;')
        ->toContain('</script>');
    expect(substr_count($head, '</script>'))->toBe(1);
});

test('practice mode needs a public test in a public course', function () {
    $author = aTeacher();
    $public = Test::factory()->for($author, 'author')->published()->create(['title' => 'Quiz one']);
    $private = Test::factory()->for($author, 'author')->create(['title' => 'Quiz two']);
    $course = aCourse($author, [$public, $private], ['visibility' => 'public', 'published_at' => now()]);

    expect(pageHead($this, "/courses/{$course->id}/tests/{$public->id}"))->toContain('Quiz one (practice)')->toContain('"@type":"Quiz"');
    expect(pageHead($this, "/courses/{$course->id}/tests/{$private->id}"))->not->toContain('Quiz two')->toContain('noindex');
});

test('materials and listings are described; a trailing slash is the same page', function () {
    $author = aTeacher();
    $material = Material::factory()->for($author, 'author')->published()->create(['title' => 'Cell diagram']);

    expect(pageHead($this, "/materials/{$material->id}/"))->toContain('<title>Cell diagram · ')->toContain('"@type":"LearningResource"');
    expect(pageHead($this, '/library/courses'))->toContain('<title>Free courses · ')->toContain('<link rel="canonical" href="https://classroom.test/library/courses"');
});

test('only an active Role::isPublic() user has a profile head', function () {
    foreach (Role::cases() as $role) {
        $user = User::factory()->create(['role' => $role, 'name' => "Person {$role->value}"]);
        $head = pageHead($this, "/teachers/{$user->id}");
        expect(str_contains($head, "Person {$role->value}"))->toBe($role->isPublic(), "role {$role->value}");
    }
});

test('paths it does not describe are 404, so index.php serves index.html untouched', function () {
    foreach (['/login', '/profile', '/tests/new', 'courses/1', '/courses/abc', ''] as $path) {
        $this->getJson('/api/page-head?path='.rawurlencode($path))->assertNotFound();
    }
});

test('it has its own throttle bucket, not the shared guest one', function () {
    // Every page load reaches this from the SPA host's one IP; were it in the
    // shared guest bucket, seven calls would leave a throttle:6,1 route 429.
    for ($i = 0; $i < 7; $i++) {
        $this->getJson('/api/page-head?path=%2F')->assertOk();
    }
    $this->postJson('/api/auth/forgot-password', [])->assertUnprocessable();
});

// The web host's index.php helpers: plain PHP outside Laravel, tested here
// because this is the PHP suite CI runs.
require_once dirname(__DIR__, 4).'/web/src/server/page-head.lib.php';

describe('the web host\'s index.php helpers', function () {
    $html = "<!DOCTYPE html>\n<html>\n  <head>\n    <meta charset=\"utf-8\" />\n    <title>24 Hour Classroom</title>\n    <meta name=\"description\" content=\"Static.\" />\n    <script type=\"module\" src=\"/build/app.esm.js\"></script>\n  </head>\n  <body></body>\n</html>";

    test('splices the fragment in place of the static title and description', function () use ($html) {
        $out = page_head_splice($html, '<title>Engines</title>');

        expect($out)->toContain('<title>Engines</title>')
            ->not->toContain('24 Hour Classroom')
            ->not->toContain('Static.')
            ->toContain('app.esm.js');
        expect(strpos($out, '<title>Engines</title>'))->toBeLessThan(strpos($out, '</head>'));
    });

    test('asks only for public pages, and any failure serves index.html unchanged', function () use ($html) {
        $asked = [];
        $fetch = function (string $url) use (&$asked) {
            $asked[] = $url;

            return '<title>X</title>';
        };

        foreach (['/login', '/profile', '/tests/new', '/attempts/3'] as $path) {
            expect(page_head_render($html, $path, 'https://api.test', $fetch))->toBe($html);
        }
        expect($asked)->toBe([]);

        expect(page_head_render($html, '/courses/7/tests/9', 'https://api.test/', $fetch))->toContain('<title>X</title>');
        expect($asked)->toBe(['https://api.test/api/page-head?path=%2Fcourses%2F7%2Ftests%2F9']);

        expect(page_head_render($html, '/courses/7', 'https://api.test', fn () => null))->toBe($html);
        expect(page_head_render($html, '/courses/7', '', $fetch))->toBe($html);
    });

    test('wants exactly the paths PageHead resolves', function () {
        foreach (['/', '/library', '/library/tests', '/teachers', '/teachers/3', '/courses/7', '/courses/7/tests/9', '/tests/9', '/materials/2', '/materials/2/'] as $path) {
            expect(page_head_wanted($path))->toBeTrue($path);
        }
        foreach (['/login', '/tests/new', '/courses/new', '/courses/7/edit', '/library/other', '/attempts/1'] as $path) {
            expect(page_head_wanted($path))->toBeFalse($path);
        }
    });
});
