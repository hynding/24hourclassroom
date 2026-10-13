<?php

use App\Enums\Role;
use App\Models\Course;
use App\Models\Material;
use App\Models\Test;
use App\Models\User;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

function courseBody(array $overrides = []): array
{
    return array_merge([
        'title' => 'Biology 101',
        'description' => 'A term of cells and genes.',
        'subject' => 'science',
        'grade_level' => '9-12',
        'items' => [],
    ], $overrides);
}

test('only a teacher may create a course, and a non-teacher learns nothing from a malformed body', function () {
    $this->postJson('/api/courses', courseBody())->assertStatus(401);

    foreach (Role::cases() as $role) {
        if ($role === Role::Teacher) {
            continue;
        }
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        $this->postJson('/api/courses', ['title' => ''])->assertStatus(403);
        $this->postJson('/api/courses', courseBody())->assertStatus(403);
    }
    expect(Course::count())->toBe(0);
});

test('a teacher builds a private course from their own tests and materials, in order, under sections', function () {
    $me = aTeacher();
    $quiz = aTestWithQuestions($me, 2, ['title' => 'Quiz 1']);
    $guide = Material::factory()->for($me, 'author')->create(['title' => 'Guide 1']);
    $this->actingAs($me);

    $res = $this->postJson('/api/courses', courseBody(['items' => [
        ['kind' => 'material', 'id' => $guide->id, 'section' => '  Unit 1  '],
        ['kind' => 'test', 'id' => $quiz->id, 'section' => 'Unit 1'],
    ]]))->assertStatus(201);

    $res->assertJsonPath('visibility', 'private')
        ->assertJsonPath('published_at', null)
        ->assertJsonPath('is_author', true)
        ->assertJsonPath('test_count', 1)
        ->assertJsonPath('material_count', 1)
        ->assertJsonPath('items.0.kind', 'material')
        ->assertJsonPath('items.0.section', 'Unit 1')
        ->assertJsonPath('items.0.material.title', 'Guide 1')
        ->assertJsonPath('items.1.kind', 'test')
        ->assertJsonPath('items.1.test.id', $quiz->id)
        ->assertJsonPath('items.1.test.question_count', 2);
    expect($res->json('items.0'))->not->toHaveKey('test')
        ->and($quiz->fresh()->visibility->value)->toBe('private')
        ->and($guide->fresh()->visibility->value)->toBe('private');
});

test('an item must be the teacher\'s own -- someone else\'s and a missing id read the same -- and listed once', function () {
    $me = aTeacher();
    $mine = aTestWithQuestions($me, 1);
    $theirs = aTestWithQuestions(aTeacher(), 1, ['visibility' => 'public', 'published_at' => now()]);
    $theirMaterial = Material::factory()->published()->create();
    $this->actingAs($me);

    $foreign = $this->postJson('/api/courses', courseBody(['items' => [['kind' => 'test', 'id' => $theirs->id]]]))->assertStatus(422);
    $missing = $this->postJson('/api/courses', courseBody(['items' => [['kind' => 'test', 'id' => 999999]]]))->assertStatus(422);
    expect($foreign->json('errors'))->toBe($missing->json('errors'))
        ->and($foreign->json('errors')['items.0.id'])->toBe(['Choose one of your own tests.']);

    $this->postJson('/api/courses', courseBody(['items' => [['kind' => 'material', 'id' => $theirMaterial->id]]]))
        ->assertStatus(422)->assertJsonPath('errors', ['items.0.id' => ['Choose one of your own materials.']]);

    // A test id offered as a material is not one of the teacher's materials.
    $this->postJson('/api/courses', courseBody(['items' => [['kind' => 'material', 'id' => $mine->id]]]))->assertStatus(422);

    $this->postJson('/api/courses', courseBody(['items' => [['kind' => 'test', 'id' => $mine->id], ['kind' => 'test', 'id' => $mine->id]]]))
        ->assertStatus(422)->assertJsonPath('errors', ['items.1.id' => ['This is already in the course.']]);

    $this->postJson('/api/courses', courseBody(['items' => [['kind' => 'lesson', 'id' => $mine->id]]]))->assertStatus(422);
    $this->postJson('/api/courses', courseBody(['items' => null]))->assertStatus(422);

    expect(Course::count())->toBe(0);
});

test('an update rewrites the item list; a non-author gets 404 on a private course and 403 on a public one', function () {
    $me = aTeacher();
    [$a, $b] = [aTestWithQuestions($me, 1), aTestWithQuestions($me, 1)];
    $course = aCourse($me, [$a, $b]);
    $this->actingAs($me);

    $this->putJson("/api/courses/{$course->id}", courseBody(['title' => 'Renamed', 'items' => [['kind' => 'test', 'id' => $b->id, 'section' => 'Only']]]))
        ->assertOk()
        ->assertJsonPath('title', 'Renamed')
        ->assertJsonCount(1, 'items')
        ->assertJsonPath('items.0.test.id', $b->id)
        ->assertJsonPath('items.0.position', 0)
        ->assertJsonPath('items.0.section', 'Only');
    expect(Test::count())->toBe(2);

    $other = aTeacher();
    $this->actingAs($other);
    $this->putJson("/api/courses/{$course->id}", courseBody())->assertStatus(404);
    $this->deleteJson("/api/courses/{$course->id}")->assertStatus(404);

    $course->update(['visibility' => 'public', 'published_at' => now()]);
    $this->putJson("/api/courses/{$course->id}", ['title' => ''])->assertStatus(403);
    $this->deleteJson("/api/courses/{$course->id}")->assertStatus(403);
});

test('deleting a course keeps its tests and materials', function () {
    $me = aTeacher();
    $test = aTestWithQuestions($me, 1);
    $material = Material::factory()->for($me, 'author')->create();
    $course = aCourse($me, [$test, $material]);
    $this->actingAs($me);

    $this->deleteJson("/api/courses/{$course->id}")->assertNoContent();

    expect(Course::count())->toBe(0)
        ->and(Test::find($test->id))->not->toBeNull()
        ->and(Material::find($material->id))->not->toBeNull();
});

test('deleting a test or material takes it out of the course', function () {
    $me = aTeacher();
    $test = aTestWithQuestions($me, 1);
    $material = Material::factory()->for($me, 'author')->create();
    $course = aCourse($me, [$test, $material]);

    $test->delete();
    $material->delete();

    expect($course->items()->count())->toBe(0);
});

test('the shelf lists the teacher\'s own courses with item counts; only teachers have one', function () {
    $me = aTeacher();
    $course = aCourse($me, [aTestWithQuestions($me, 1), aTestWithQuestions($me, 1), Material::factory()->for($me, 'author')->create()]);
    aCourse(aTeacher());
    $this->actingAs($me);

    $res = $this->getJson('/api/courses')->assertOk();
    expect($res->json('data'))->toHaveCount(1)
        ->and($res->json('data.0.id'))->toBe($course->id)
        ->and($res->json('data.0.test_count'))->toBe(2)
        ->and($res->json('data.0.material_count'))->toBe(1)
        ->and($res->json('meta.total'))->toBe(1);

    foreach (Role::cases() as $role) {
        if ($role === Role::Teacher) {
            continue;
        }
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        $this->getJson('/api/courses')->assertStatus(403);
        $this->getJson('/api/courses/candidates')->assertStatus(403);
    }
});

test('the editor\'s candidates are every one of the teacher\'s own tests and materials, by title', function () {
    $me = aTeacher();
    aTestWithQuestions($me, 3, ['title' => 'Beta']);
    aTestWithQuestions($me, 0, ['title' => 'Alpha']);
    Material::factory()->for($me, 'author')->create(['title' => 'Notes', 'original_name' => 'notes.md']);
    aTestWithQuestions(aTeacher(), 1, ['title' => 'Not mine', 'visibility' => 'public', 'published_at' => now()]);
    $this->actingAs($me);

    $res = $this->getJson('/api/courses/candidates')->assertOk();
    expect(array_column($res->json('tests'), 'title'))->toBe(['Alpha', 'Beta'])
        ->and($res->json('tests.1.question_count'))->toBe(3)
        ->and($res->json('tests.1.visibility'))->toBe('private')
        ->and($res->json('materials'))->toHaveCount(1)
        ->and($res->json('materials.0.original_name'))->toBe('notes.md');
});
