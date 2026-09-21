<?php

use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
    Storage::fake(config('materials.disk'));
});

test('the library lists public materials by active authors, newest published first, with filters', function () {
    $author = aTeacher();
    $math = aMaterial($author, ['visibility' => 'public', 'published_at' => now()->subDay(), 'subject' => 'math', 'grade_level' => '3-5', 'title' => 'Fractions', 'description' => 'Numerators.']);
    $science = aMaterial($author, ['visibility' => 'public', 'published_at' => now(), 'subject' => 'science', 'grade_level' => '6-8', 'title' => 'Cells']);

    aMaterial($author, ['title' => 'A private draft']);

    $gone = aTeacher();
    aMaterial($gone, ['visibility' => 'public', 'published_at' => now(), 'title' => 'By a deactivated author']);
    $gone->forceFill(['deactivated_at' => now()])->save();

    $page = $this->getJson('/api/library/materials')->assertOk()
        ->assertJsonCount(2, 'data')
        ->assertJsonPath('data.0.id', $science->id)
        ->assertJsonPath('data.1.id', $math->id)
        ->assertJsonPath('data.0.author.name', $author->name);

    // Exactly the MaterialSummary shape -- no description, no download_url.
    expect(array_keys($page->json('data.0')))->toBe([
        'id', 'title', 'subject', 'grade_level', 'visibility', 'published_at',
        'original_name', 'mime_type', 'size_bytes', 'author',
    ]);

    $this->getJson('/api/library/materials?subject=math')->assertOk()
        ->assertJsonCount(1, 'data')->assertJsonPath('data.0.id', $math->id);
    $this->getJson('/api/library/materials?grade=6-8')->assertOk()
        ->assertJsonCount(1, 'data')->assertJsonPath('data.0.id', $science->id);
    $this->getJson('/api/library/materials?q=frac')->assertOk()->assertJsonCount(1, 'data');
    // The description is searched too.
    $this->getJson('/api/library/materials?q=numerator')->assertOk()->assertJsonCount(1, 'data');
    // LIKE wildcards are escaped, so a bare % matches nothing.
    $this->getJson('/api/library/materials?q=%25')->assertOk()->assertJsonCount(0, 'data');
    $this->getJson('/api/library/materials?subject=nope')->assertStatus(422);
});

test('the library paginates 15 to a page and keeps its filters on page 2', function () {
    $author = aTeacher();
    foreach (range(1, 16) as $i) {
        aMaterial($author, [
            'visibility' => 'public',
            'published_at' => now()->subMinutes(20 - $i),
            'subject' => 'math',
            'title' => "Sheet {$i}",
        ]);
    }

    $this->getJson('/api/library/materials?subject=math')->assertOk()
        ->assertJsonCount(15, 'data')->assertJsonPath('meta.total', 16)
        ->assertJsonPath('data.0.title', 'Sheet 16');

    $this->getJson('/api/library/materials?subject=math&page=2')->assertOk()
        ->assertJsonCount(1, 'data')->assertJsonPath('data.0.title', 'Sheet 1');
});

test('the library is readable logged out and never leaks a private material by id order', function () {
    $author = aTeacher();
    aMaterial($author, ['title' => 'Private']);
    aMaterial($author, ['visibility' => 'public', 'published_at' => now(), 'title' => 'Public']);

    $titles = collect($this->getJson('/api/library/materials')->assertOk()->json('data'))->pluck('title');
    expect($titles->all())->toBe(['Public']);
});
