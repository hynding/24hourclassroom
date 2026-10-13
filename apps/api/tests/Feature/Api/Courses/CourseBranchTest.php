<?php

use App\Enums\Role;
use App\Models\Course;
use App\Models\Material;
use App\Models\Question;
use App\Models\Test;
use App\Models\User;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
});

/** A public course: a reading, a quiz with two questions, and items a visitor cannot see. */
function branchableCourse(): array
{
    $author = aTeacher(['name' => 'Ms K']);
    $reading = Material::factory()->for($author, 'author')->published()->create(['title' => 'Bio · Reading']);
    $quiz = aTestWithQuestions($author, 2, ['title' => 'Bio · Quiz', 'visibility' => 'public', 'published_at' => now(), 'slug' => 'bio-quiz']);
    $quiz->questions()->first()->update(['option_explanations' => ['a', 'b', 'c', 'd'], 'explanation' => 'Because.', 'slug' => 'q-1']);
    $hiddenTest = aTestWithQuestions($author, 1, ['title' => 'Unpublished test']);
    $hiddenMaterial = Material::factory()->for($author, 'author')->create(['title' => 'Unpublished notes']);
    $course = aCourse($author, [$reading, $quiz, $hiddenTest, $hiddenMaterial], ['title' => 'Bio', 'visibility' => 'public', 'published_at' => now()], 'Unit 1');

    return [$course, $author, $reading, $quiz];
}

test('a teacher branches a public course into a private one: tests copied as their own, readings kept from the original', function () {
    [$course, $author, $reading, $quiz] = branchableCourse();
    $me = aTeacher();
    $this->actingAs($me);

    $this->getJson("/api/courses/{$course->id}")->assertOk()->assertJsonPath('can_branch', true)->assertJsonPath('my_branch_id', null);

    $res = $this->postJson("/api/courses/{$course->id}/branch")->assertCreated()
        ->assertJsonPath('title', 'Bio')
        ->assertJsonPath('visibility', 'private')
        ->assertJsonPath('is_author', true)
        ->assertJsonPath('author.id', $me->id)
        ->assertJsonPath('can_branch', false)
        ->assertJsonPath('branched_from', ['id' => $course->id, 'title' => 'Bio', 'author' => ['id' => $author->id, 'name' => 'Ms K']])
        ->assertJsonCount(2, 'items')
        ->assertJsonPath('items.0.kind', 'material')
        ->assertJsonPath('items.0.material.id', $reading->id)
        ->assertJsonPath('items.0.material.author.id', $author->id)
        ->assertJsonPath('items.0.section', 'Unit 1')
        ->assertJsonPath('items.1.kind', 'test')
        ->assertJsonPath('items.1.test.visibility', 'private');

    // The copy is the teacher's own, private, with the questions and answers.
    $copy = Test::findOrFail($res->json('items.1.test.id'));
    expect($copy->id)->not->toBe($quiz->id)
        ->and($copy->user_id)->toBe($me->id)
        ->and($copy->copied_from_id)->toBe($quiz->id)
        ->and($copy->slug)->toBeNull()
        ->and($copy->questions->pluck('prompt')->all())->toBe($quiz->questions->pluck('prompt')->all())
        ->and($copy->questions[0]->option_explanations)->toBe(['a', 'b', 'c', 'd'])
        ->and($copy->questions[0]->slug)->toBeNull()
        // Nothing the visitor could not see was copied, and no file either.
        ->and(Test::where('user_id', $me->id)->count())->toBe(1)
        ->and(Material::where('user_id', $me->id)->count())->toBe(0);

    // The original is untouched, and now points the teacher at their branch.
    expect($course->fresh()->items()->count())->toBe(4)
        ->and($quiz->fresh()->questions)->toHaveCount(2);
    $this->getJson("/api/courses/{$course->id}")->assertOk()->assertJsonPath('my_branch_id', $res->json('id'));
});

test('a branch stays private: nobody else sees it, its tests or their answers', function () {
    [$course] = branchableCourse();
    $me = aTeacher();
    $this->actingAs($me);
    $branch = $this->postJson("/api/courses/{$course->id}/branch")->assertCreated()->json();
    $copyId = $branch['items'][1]['test']['id'];

    // The teacher writes a question of their own into the copy.
    $this->putJson("/api/tests/{$copyId}", [
        'title' => 'My quiz', 'subject' => 'science', 'grade_level' => '9-12',
        'questions' => [['type' => 'true_false', 'prompt' => 'My own question', 'answer' => false]],
    ])->assertOk();
    $this->getJson("/api/courses/{$branch['id']}/tests/{$copyId}")->assertOk()->assertJsonPath('questions.0.answer', false);

    foreach ([null, ...Role::cases()] as $role) {
        $this->app['auth']->forgetGuards();
        if ($role !== null) {
            $this->actingAs(User::factory()->create(['role' => $role->value]));
        }
        $this->getJson("/api/courses/{$branch['id']}")->assertStatus(404);
        $this->getJson("/api/courses/{$branch['id']}/tests/{$copyId}")->assertStatus(404);
        $this->getJson("/api/tests/{$copyId}")->assertStatus(404);
    }
    // And it never reaches the library.
    expect(collect($this->getJson('/api/library/courses')->json('data'))->pluck('id')->all())->toBe([$course->id]);
});

test('only another teacher may branch, and only a public course', function () {
    [$course, $author] = branchableCourse();

    $this->postJson("/api/courses/{$course->id}/branch")->assertStatus(401);
    foreach (Role::cases() as $role) {
        if ($role === Role::Teacher) {
            continue;
        }
        $this->actingAs(User::factory()->create(['role' => $role->value]));
        $this->getJson("/api/courses/{$course->id}")->assertOk()->assertJsonPath('can_branch', false);
        $this->postJson("/api/courses/{$course->id}/branch")->assertStatus(403);
    }

    $this->actingAs($author);
    $this->getJson("/api/courses/{$course->id}")->assertOk()->assertJsonPath('can_branch', false);
    $this->postJson("/api/courses/{$course->id}/branch")->assertStatus(403);

    $course->update(['visibility' => 'private']);
    $this->postJson("/api/courses/{$course->id}/branch")->assertStatus(404);
    $this->actingAs(aTeacher());
    $this->postJson("/api/courses/{$course->id}/branch")->assertStatus(404);

    expect(Course::count())->toBe(1);
});

test('a branch can keep, reorder and drop the original\'s materials, but not add anyone else\'s', function () {
    [$course, $author, $reading] = branchableCourse();
    $me = aTeacher();
    $this->actingAs($me);
    $branch = $this->postJson("/api/courses/{$course->id}/branch")->json();
    $copyId = $branch['items'][1]['test']['id'];
    $body = fn (array $items) => ['title' => 'Mine', 'subject' => 'science', 'grade_level' => '9-12', 'items' => $items];

    $this->putJson("/api/courses/{$branch['id']}", $body([
        ['kind' => 'test', 'id' => $copyId], ['kind' => 'material', 'id' => $reading->id, 'section' => 'Read first'],
    ]))->assertOk()->assertJsonPath('items.1.material.id', $reading->id)->assertJsonPath('items.1.section', 'Read first');

    $other = Material::factory()->for($author, 'author')->published()->create();
    $this->putJson("/api/courses/{$branch['id']}", $body([['kind' => 'material', 'id' => $other->id]]))
        ->assertStatus(422)->assertJsonPath('errors', ['items.0.id' => ['Choose one of your own materials.']]);
    // A new course cannot borrow one either.
    $this->postJson('/api/courses', $body([['kind' => 'material', 'id' => $reading->id]]))->assertStatus(422);
    // Nor can a branch take the original's TEST rather than its own copy.
    $this->putJson("/api/courses/{$branch['id']}", $body([['kind' => 'test', 'id' => $course->items()->whereNotNull('test_id')->value('test_id')]]))
        ->assertStatus(422);

    // Dropped is dropped: once removed, it cannot come back through the editor.
    $this->putJson("/api/courses/{$branch['id']}", $body([['kind' => 'test', 'id' => $copyId]]))->assertOk();
    $this->putJson("/api/courses/{$branch['id']}", $body([['kind' => 'material', 'id' => $reading->id]]))->assertStatus(422);
});

test('the original\'s material leaves the branch when it is unpublished, and publishing the branch never touches it', function () {
    [$course, $author, $reading] = branchableCourse();
    $me = aTeacher();
    $this->actingAs($me);
    $branch = Course::findOrFail($this->postJson("/api/courses/{$course->id}/branch")->json('id'));

    $this->postJson("/api/courses/{$branch->id}/publish")->assertOk()
        ->assertJsonPath('test_count', 1)
        ->assertJsonPath('material_count', 1)
        ->assertJsonPath('items.1.test.visibility', 'public');
    $this->app['auth']->forgetGuards();
    $this->getJson("/api/courses/{$branch->id}")->assertOk()->assertJsonPath('branched_from.id', $course->id);
    $row = collect($this->getJson('/api/library/courses')->json('data'))->firstWhere('id', $branch->id);
    expect($row['material_count'])->toBe(1)->and($row['test_count'])->toBe(1);

    $reading->update(['visibility' => 'private']);
    $this->getJson("/api/courses/{$branch->id}")->assertOk()->assertJsonCount(1, 'items')->assertJsonPath('material_count', 0);
    $this->actingAs($me);
    $this->getJson("/api/courses/{$branch->id}")->assertOk()->assertJsonCount(1, 'items');
    $this->postJson("/api/courses/{$branch->id}/publish")->assertOk();
    expect($reading->fresh()->visibility->value)->toBe('private');

    // The original going private hides where the branch came from; deleting it orphans the branch, nothing more.
    $course->update(['visibility' => 'private']);
    $this->getJson("/api/courses/{$branch->id}")->assertOk()->assertJsonPath('branched_from', null);
    $course->delete();
    expect($branch->fresh()->branched_from_id)->toBeNull();
});

test('branching copies a course whose questions span every type, in order', function () {
    $author = aTeacher();
    $test = Test::factory()->for($author, 'author')->published()->create();
    Question::factory()->for($test)->multiSelect(partial: true)->create(['position' => 0]);
    Question::factory()->for($test)->numeric(3.5, 0.1)->create(['position' => 1]);
    Question::factory()->for($test)->fillBlank(['polar', 'polarity'], autoGrade: false)->create(['position' => 2, 'stimulus' => 'Shared passage']);
    Question::factory()->for($test)->longAnswer()->create(['position' => 3]);
    $course = aCourse($author, [$test], ['visibility' => 'public', 'published_at' => now()]);
    $this->actingAs(aTeacher());

    $copyId = $this->postJson("/api/courses/{$course->id}/branch")->assertCreated()->json('items.0.test.id');

    $fields = fn (Test $t) => $t->questions->map(fn ($q) => $q->only(['position', 'type', 'stimulus', 'options', 'answer', 'points', 'partial_credit', 'auto_grade']))->all();
    expect($fields(Test::findOrFail($copyId)))->toEqual($fields($test->fresh()));
});
