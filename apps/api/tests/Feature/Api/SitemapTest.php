<?php

use App\Enums\Role;
use App\Models\Material;
use App\Models\Test;
use App\Models\User;

beforeEach(function () {
    config(['app.frontend_urls' => 'https://classroom.test,https://other.test']);
});

/** @return list<string> every <loc> in the sitemap, in order */
function sitemapUrls($test): array
{
    $response = $test->get('/api/sitemap.xml')->assertOk();
    expect($response->headers->get('Content-Type'))->toStartWith('application/xml');
    $xml = simplexml_load_string($response->getContent());
    expect($xml)->not->toBeFalse();

    $urls = [];
    foreach ($xml->url as $url) {
        $urls[] = (string) $url->loc;
    }

    return $urls;
}

test('a guest gets the listings as SPA-origin URLs', function () {
    $urls = sitemapUrls($this);

    expect($urls)->toContain('https://classroom.test/')
        ->toContain('https://classroom.test/library/courses')
        ->toContain('https://classroom.test/teachers');
});

test('it lists exactly the public courses, practice tests, tests and materials a guest can open', function () {
    $author = aTeacher();
    $public = Test::factory()->for($author, 'author')->published()->create();
    $private = Test::factory()->for($author, 'author')->create();
    $material = Material::factory()->for($author, 'author')->published()->create();
    $hiddenMaterial = Material::factory()->for($author, 'author')->create();
    $course = aCourse($author, [$public, $private, $material], ['visibility' => 'public', 'published_at' => now()]);
    $privateCourse = aCourse($author, [$public]);

    $urls = sitemapUrls($this);

    expect($urls)->toContain("https://classroom.test/courses/{$course->id}")
        ->toContain("https://classroom.test/courses/{$course->id}/tests/{$public->id}")
        ->toContain("https://classroom.test/tests/{$public->id}")
        ->toContain("https://classroom.test/materials/{$material->id}")
        ->toContain("https://classroom.test/teachers/{$author->id}")
        ->not->toContain("https://classroom.test/courses/{$course->id}/tests/{$private->id}")
        ->not->toContain("https://classroom.test/tests/{$private->id}")
        ->not->toContain("https://classroom.test/materials/{$hiddenMaterial->id}")
        ->not->toContain("https://classroom.test/courses/{$privateCourse->id}")
        ->not->toContain("https://classroom.test/courses/{$privateCourse->id}/tests/{$public->id}");
});

test('a deactivated author drops out with everything they made', function () {
    $author = aTeacher(['deactivated_at' => now()]);
    $test = Test::factory()->for($author, 'author')->published()->create();
    $material = Material::factory()->for($author, 'author')->published()->create();
    $course = aCourse($author, [$test], ['visibility' => 'public', 'published_at' => now()]);

    $urls = implode("\n", sitemapUrls($this));

    expect($urls)->not->toContain("/courses/{$course->id}")
        ->not->toContain("/tests/{$test->id}")
        ->not->toContain("/materials/{$material->id}")
        ->not->toContain("/teachers/{$author->id}");
});

test('only Role::isPublic() profiles are listed', function () {
    $users = collect(Role::cases())->mapWithKeys(fn (Role $role) => [$role->value => User::factory()->create(['role' => $role])]);

    $urls = sitemapUrls($this);

    foreach ($users as $role => $user) {
        $listed = in_array("https://classroom.test/teachers/{$user->id}", $urls, true);
        expect($listed)->toBe(Role::from($role)->isPublic(), "role {$role}");
    }
});

test('a course\'s practice entry needs the test to be the course author\'s own', function () {
    $author = aTeacher();
    $other = aTeacher();
    $foreign = Test::factory()->for($other, 'author')->published()->create();
    $course = aCourse($author, [$foreign], ['visibility' => 'public', 'published_at' => now()]);

    expect(sitemapUrls($this))->not->toContain("https://classroom.test/courses/{$course->id}/tests/{$foreign->id}");
});
