<?php

use App\Models\Test;
use App\Support\ShareCard;

beforeEach(function () {
    config(['app.frontend_urls' => 'https://classroom.test']);
    if (! ShareCard::supported()) {
        $this->markTestSkipped('GD with FreeType is not available');
    }
});

function pageImage($test, string $path): string
{
    $res = $test->get('/api/page-image?path='.rawurlencode($path))->assertOk()
        ->assertHeader('Content-Type', 'image/png');
    expect($res->headers->get('Cache-Control'))->toContain('public');

    return $res->getContent();
}

test('a public course gets its own 1200×630 PNG card', function () {
    $author = aTeacher();
    $course = aCourse($author, [Test::factory()->for($author, 'author')->published()->create()], ['visibility' => 'public', 'published_at' => now(), 'title' => 'Engines']);

    $png = pageImage($this, "/courses/{$course->id}");
    expect(substr($png, 0, 8))->toBe("\x89PNG\r\n\x1a\n");
    [$w, $h] = getimagesizefromstring($png);
    expect([$w, $h])->toBe([ShareCard::WIDTH, ShareCard::HEIGHT]);
    expect($png)->not->toBe(pageImage($this, '/'));
});

test('a private course, a missing one and an undescribed path all get the site card', function () {
    $author = aTeacher();
    $private = aCourse($author, [], ['title' => 'Secret plans']);
    $site = pageImage($this, '/');

    foreach (["/courses/{$private->id}", '/courses/999999', '/login', 'nonsense', ''] as $path) {
        expect(pageImage($this, $path))->toBe($site, $path);
    }
});

test('a card is cached by what it draws, so an edit draws a new one', function () {
    $author = aTeacher();
    $course = aCourse($author, [], ['visibility' => 'public', 'published_at' => now(), 'title' => 'Engines']);

    $first = pageImage($this, "/courses/{$course->id}");
    expect(pageImage($this, "/courses/{$course->id}"))->toBe($first);

    $course->update(['title' => 'Steam engines']);
    expect(pageImage($this, "/courses/{$course->id}"))->not->toBe($first);
});

test('long titles and details are drawn without error', function () {
    $png = ShareCard::png('Free course', str_repeat('Supercalifragilistic ', 30), str_repeat('detail ', 80), str_repeat('Site ', 20), 'a-very-long-host-name.example.org');
    expect(getimagesizefromstring($png)[0])->toBe(ShareCard::WIDTH);
});

test('it has its own throttle bucket, not the shared guest one', function () {
    for ($i = 0; $i < 7; $i++) {
        $this->get('/api/page-image?path=%2F')->assertOk();
    }
    $this->postJson('/api/auth/forgot-password', [])->assertUnprocessable();
});
