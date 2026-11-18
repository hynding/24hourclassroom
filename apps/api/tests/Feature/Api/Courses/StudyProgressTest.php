<?php

use App\Enums\Role;
use App\Models\Material;
use App\Models\Question;
use App\Models\StudyProgress;
use App\Models\Test;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->withHeader('Referer', 'http://localhost:3333');
    Storage::fake(config('materials.disk'));
});

/** A public course: one public test (an MC worth 2, a short answer worth 3) and one public material. */
function progressCourse(): array
{
    $author = aTeacher();
    $test = Test::factory()->for($author, 'author')->published()->create();
    $mc = Question::factory()->for($test)->create(['position' => 0, 'answer' => 1, 'points' => 2]);
    Question::factory()->for($test)->shortAnswer()->create(['position' => 1, 'points' => 3]);
    $material = aMaterial($author, ['visibility' => 'public', 'published_at' => now()]);
    $course = aCourse($author, [$material, $test], ['visibility' => 'public', 'published_at' => now()]);

    return [$course, $test, $mc, $material, $author];
}

function practise($case, $course, Test $test, array $responses)
{
    return $case->postJson("/api/courses/{$course->id}/tests/{$test->id}/check", ['responses' => $responses])->assertOk();
}

test('a guest\'s practice run is graded and nothing is kept', function () {
    [$course, $test, $mc] = progressCourse();

    practise($this, $course, $test, [$mc->id => 1])->assertJsonPath('progress', null);
    $this->getJson("/api/courses/{$course->id}")->assertOk()->assertJsonPath('progress', null);
    $this->getJson("/api/courses/{$course->id}/tests/{$test->id}")->assertOk()->assertJsonPath('progress', null);

    expect(StudyProgress::count())->toBe(0);
});

test('a learner\'s runs keep their best and latest score, over the marked points only', function () {
    [$course, $test, $mc] = progressCourse();
    $student = aStudent();
    $this->actingAs($student);

    // Right: 2 of the 2 marked points (the short answer is the learner's to compare).
    practise($this, $course, $test, [$mc->id => 1])
        ->assertJsonPath('progress.best_max', 2)
        ->assertJsonPath('progress.runs', 1);
    // Wrong: the best stays, the latest moves.
    $res = practise($this, $course, $test, [$mc->id => 0])->assertJsonPath('progress.runs', 2);
    expect($res->json('progress.best_score'))->toEqual(2);

    $row = StudyProgress::sole();
    expect($row->user_id)->toBe($student->id)
        ->and($row->last_score)->toEqual(0)
        ->and($row->best_score)->toEqual(2)
        ->and($row->done_at)->not->toBeNull();

    $this->getJson("/api/courses/{$course->id}/tests/{$test->id}")->assertOk()
        ->assertJsonPath('progress.runs', 2);
});

test('the course page carries the viewer\'s own progress, keyed by course item', function () {
    [$course, $test, $mc, $material] = progressCourse();
    $student = aStudent();
    $other = aStudent();
    $testItem = $course->items()->where('test_id', $test->id)->value('id');
    $materialItem = $course->items()->where('material_id', $material->id)->value('id');

    $this->actingAs($student);
    $this->getJson("/api/courses/{$course->id}")->assertOk()->assertJsonPath('progress.items', []);
    practise($this, $course, $test, [$mc->id => 1]);
    $this->putJson("/api/materials/{$material->id}/done")->assertOk()->assertJsonPath('done_at', fn ($v) => $v !== null);

    $view = $this->getJson("/api/courses/{$course->id}")->assertOk();
    expect($view->json("progress.items.{$testItem}.best_score"))->toEqual(2)
        ->and($view->json("progress.items.{$testItem}.best_max"))->toBe(2)
        ->and($view->json("progress.items.{$materialItem}.done_at"))->not->toBeNull();
    $this->getJson("/api/materials/{$material->id}")->assertOk()->assertJsonPath('progress.done_at', fn ($v) => $v !== null);

    // Nobody else sees it, a connected teacher included.
    $this->actingAs($other)->getJson("/api/courses/{$course->id}")->assertOk()->assertJsonPath('progress.items', []);
    $teacher = aTeacher();
    connectAccepted($teacher, $student);
    $this->actingAs($teacher)->getJson("/api/courses/{$course->id}")->assertOk()->assertJsonPath('progress.items', []);

    // Unmarking removes the row.
    $this->actingAs($student)->deleteJson("/api/materials/{$material->id}/done")->assertOk()->assertJsonPath('done_at', null);
    expect(StudyProgress::whereNotNull('material_id')->count())->toBe(0);
});

test('done in one course is done in every course holding the same item', function () {
    [$course, $test, $mc, $material, $author] = progressCourse();
    $second = aCourse($author, [$test, $material], ['visibility' => 'public', 'published_at' => now()]);
    $this->actingAs(aStudent());

    practise($this, $course, $test, [$mc->id => 1]);
    $this->putJson("/api/materials/{$material->id}/done")->assertOk();

    expect(count((array) $this->getJson("/api/courses/{$second->id}")->json('progress.items')))->toBe(2);
});

test('nothing is kept for the author, an admin or an unverified account', function () {
    [$course, $test, $mc, $material, $author] = progressCourse();

    foreach ([$author, User::factory()->create(['role' => 'admin']), aStudent(['email_verified_at' => null])] as $viewer) {
        $this->actingAs($viewer);
        practise($this, $course, $test, [$mc->id => 1])->assertJsonPath('progress', null);
        $this->getJson("/api/courses/{$course->id}")->assertOk()->assertJsonPath('progress', null);
    }
    $this->actingAs($author)->putJson("/api/materials/{$material->id}/done")->assertForbidden();
    $this->actingAs(User::factory()->create(['role' => 'admin']))->putJson("/api/materials/{$material->id}/done")->assertForbidden();

    expect(StudyProgress::count())->toBe(0);
});

test('a material the viewer cannot see cannot be marked', function () {
    $author = aTeacher();
    $private = aMaterial($author, ['visibility' => 'private']);

    $this->actingAs(aStudent())->putJson("/api/materials/{$private->id}/done")->assertNotFound();
    expect(StudyProgress::count())->toBe(0);
});

test('progress is kept for the five self-assignable roles only', function () {
    $tracked = array_values(array_filter(Role::cases(), fn (Role $r) => $r->tracksStudyProgress()));

    expect($tracked)->toBe([Role::Teacher, Role::Student, Role::Tutor, Role::Assistant, Role::Guardian]);
});

test('progress goes with the learner and with the item', function () {
    [$course, $test, $mc, $material] = progressCourse();
    $student = aStudent();
    $this->actingAs($student);
    practise($this, $course, $test, [$mc->id => 1]);
    $this->putJson("/api/materials/{$material->id}/done")->assertOk();

    Material::whereKey($material->id)->delete();
    expect(StudyProgress::count())->toBe(1);
    $student->delete();
    expect(StudyProgress::count())->toBe(0);
});

test('a learner keeps a deck\'s known cards, apart from its done mark', function () {
    [$course, $test, $mc, $material] = progressCourse();
    $student = aStudent();
    $this->actingAs($student);

    $this->putJson("/api/materials/{$material->id}/cards", ['known' => ['a1b2', 'c3d4', 'a1b2']])->assertOk()
        ->assertJsonPath('known_cards', ['a1b2', 'c3d4'])
        ->assertJsonPath('done_at', null);
    $this->getJson("/api/materials/{$material->id}")->assertJsonPath('progress.known_cards', ['a1b2', 'c3d4']);

    // Marking and unmarking done leaves the known cards alone.
    $this->putJson("/api/materials/{$material->id}/done")->assertOk();
    $this->deleteJson("/api/materials/{$material->id}/done")->assertOk()->assertJsonPath('known_cards', ['a1b2', 'c3d4']);

    // Clearing them drops the row, since nothing else is left in it.
    $this->putJson("/api/materials/{$material->id}/cards", ['known' => []])->assertOk()->assertJsonPath('known_cards', []);
    expect(StudyProgress::count())->toBe(0);

    // Keys only: no card text.
    $this->putJson("/api/materials/{$material->id}/cards", ['known' => ['What is ATP?']])->assertUnprocessable();
    // Nobody else sees them.
    $this->actingAs(aStudent())->getJson("/api/materials/{$material->id}")->assertJsonPath('progress.known_cards', []);
});

test('known cards are kept only where progress is', function () {
    [$course, $test, $mc, $material, $author] = progressCourse();

    $this->actingAs($author)->putJson("/api/materials/{$material->id}/cards", ['known' => ['a1']])->assertForbidden();
    $this->actingAs(aStudent())->putJson('/api/materials/'.aMaterial($author, ['visibility' => 'private'])->id.'/cards', ['known' => ['a1']])->assertNotFound();
});
