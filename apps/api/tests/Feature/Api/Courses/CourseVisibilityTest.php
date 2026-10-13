<?php

use App\Enums\Role;
use App\Models\Material;
use App\Models\User;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

test('a private course is 404 for everyone but its author, byte-identical to a missing id', function () {
    $author = aTeacher();
    $course = aCourse($author, [aTestWithQuestions($author, 1)]);
    $missing = $this->getJson('/api/courses/999999')->assertStatus(404)->getContent();

    expect($this->getJson("/api/courses/{$course->id}")->assertStatus(404)->getContent())->toBe($missing);
    foreach (Role::cases() as $role) {
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        expect($this->getJson("/api/courses/{$course->id}")->assertStatus(404)->getContent())->toBe($missing);
    }

    $this->actingAs($author);
    $this->getJson("/api/courses/{$course->id}")->assertOk()->assertJsonPath('is_author', true)->assertJsonCount(1, 'items');
});

test('publishing needs at least one item, and publishes the course with its contents', function () {
    $author = aTeacher();
    $this->actingAs($author);
    $empty = aCourse($author);
    $this->postJson("/api/courses/{$empty->id}/publish")->assertStatus(422)->assertJsonValidationErrors('items');
    expect($empty->fresh()->visibility->value)->toBe('private');

    $quiz = aTestWithQuestions($author, 2);
    $draft = aTestWithQuestions($author, 0, ['title' => 'Draft with no questions']);
    $guide = Material::factory()->for($author, 'author')->create();
    $course = aCourse($author, [$guide, $quiz, $draft]);

    $this->postJson("/api/courses/{$course->id}/publish")->assertOk()
        ->assertJsonPath('visibility', 'public')
        ->assertJsonPath('items.1.test.visibility', 'public');

    expect($course->fresh()->published_at)->not->toBeNull()
        ->and($quiz->fresh()->visibility->value)->toBe('public')
        ->and($quiz->fresh()->published_at)->not->toBeNull()
        ->and($guide->fresh()->visibility->value)->toBe('public')
        // Nothing to publish: a test without questions stays private.
        ->and($draft->fresh()->visibility->value)->toBe('private');

    // Logged out: the course, minus the test that could not be published.
    $this->app['auth']->forgetGuards();
    $res = $this->getJson("/api/courses/{$course->id}")->assertOk()
        ->assertJsonPath('is_author', false)
        ->assertJsonPath('test_count', 1)
        ->assertJsonPath('material_count', 1);
    expect(collect($res->json('items'))->pluck('kind')->all())->toBe(['material', 'test']);

    // The author still sees all three, the draft marked private.
    $this->actingAs($author);
    $this->getJson("/api/courses/{$course->id}")->assertOk()
        ->assertJsonCount(3, 'items')
        ->assertJsonPath('items.2.test.visibility', 'private');
});

test('while a course is public, saving it publishes what was added and nothing its author unpublished', function () {
    $author = aTeacher();
    $kept = aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()]);
    $course = aCourse($author, [$kept], ['visibility' => 'public', 'published_at' => now()]);
    $kept->update(['visibility' => 'private']);
    $added = aTestWithQuestions($author, 1);
    $this->actingAs($author);

    $save = fn () => $this->putJson("/api/courses/{$course->id}", [
        'title' => $course->title, 'subject' => 'science', 'grade_level' => '6-8',
        'items' => [['kind' => 'test', 'id' => $kept->id], ['kind' => 'test', 'id' => $added->id]],
    ])->assertOk();

    $save()->assertJsonPath('items.0.test.visibility', 'private')->assertJsonPath('items.1.test.visibility', 'public');
    expect($added->fresh()->visibility->value)->toBe('public')
        ->and($kept->fresh()->visibility->value)->toBe('private');

    // Publishing again is the author's explicit way to sweep it back in.
    $this->postJson("/api/courses/{$course->id}/publish")->assertOk()->assertJsonPath('items.0.test.visibility', 'public');
});

test('unpublishing hides the course but leaves its contents as they are', function () {
    $author = aTeacher();
    $quiz = aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()]);
    $course = aCourse($author, [$quiz], ['visibility' => 'public', 'published_at' => now()]);
    $this->actingAs($author);

    $this->postJson("/api/courses/{$course->id}/unpublish")->assertOk()->assertJsonPath('visibility', 'private');

    expect($quiz->fresh()->visibility->value)->toBe('public');
    $this->app['auth']->forgetGuards();
    $this->getJson("/api/courses/{$course->id}")->assertStatus(404);
});

test('a visitor sees only public items; an unpublished test drops out of the course for them', function () {
    $author = aTeacher();
    $quiz = aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()]);
    $hidden = aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()]);
    $course = aCourse($author, [$quiz, $hidden], ['visibility' => 'public', 'published_at' => now()]);

    // An administrator's unpublish is a plain visibility change.
    $hidden->update(['visibility' => 'private']);

    $res = $this->getJson("/api/courses/{$course->id}")->assertOk();
    expect(collect($res->json('items'))->pluck('test.id')->all())->toBe([$quiz->id]);
});

test('an item owned by someone else is shown to nobody, the course author included', function () {
    $author = aTeacher();
    $stranger = aTeacher();
    $theirs = aTestWithQuestions($stranger, 1, ['visibility' => 'public', 'published_at' => now()]);
    $course = aCourse($author, [$theirs], ['visibility' => 'public', 'published_at' => now()]);

    $this->getJson("/api/courses/{$course->id}")->assertOk()->assertJsonCount(0, 'items');
    $this->actingAs($author);
    $this->getJson("/api/courses/{$course->id}")->assertOk()->assertJsonCount(0, 'items');
    $this->getJson("/api/courses/{$course->id}/tests/{$theirs->id}")->assertStatus(404);
});

test('a deactivated author takes their public course down with them', function () {
    $author = aTeacher();
    $course = aCourse($author, [aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()])], ['visibility' => 'public', 'published_at' => now()]);
    $author->forceFill(['deactivated_at' => now()])->save();

    $this->getJson("/api/courses/{$course->id}")->assertStatus(404);
    $this->getJson('/api/library/courses')->assertOk()->assertJsonCount(0, 'data');
});

test('the course library lists public courses with visitor-visible counts, filters and sorts', function () {
    $author = aTeacher(['name' => 'Ms Frizzle']);
    $public = aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()]);
    $private = aTestWithQuestions($author, 1);
    $bio = aCourse($author, [$public, $private], ['title' => 'Biology', 'subject' => 'science', 'grade_level' => '9-12', 'visibility' => 'public', 'published_at' => now()->subDay()]);
    $algebra = aCourse($author, [], ['title' => 'Algebra', 'subject' => 'math', 'grade_level' => '6-8', 'visibility' => 'public', 'published_at' => now()]);
    aCourse($author, [], ['title' => 'Draft course']);

    $res = $this->getJson('/api/library/courses')->assertOk();
    expect(collect($res->json('data'))->pluck('id')->all())->toBe([$algebra->id, $bio->id])
        ->and($res->json('data.1.test_count'))->toBe(1)
        ->and($res->json('data.1.author.name'))->toBe('Ms Frizzle');

    expect(collect($this->getJson('/api/library/courses?sort=title')->json('data'))->pluck('title')->all())->toBe(['Algebra', 'Biology'])
        ->and(collect($this->getJson('/api/library/courses?subject=science')->json('data'))->pluck('id')->all())->toBe([$bio->id])
        ->and(collect($this->getJson('/api/library/courses?grade=6-8&q=alg')->json('data'))->pluck('id')->all())->toBe([$algebra->id]);
    $this->getJson('/api/library/courses?subject=astrology')->assertStatus(422);
});
