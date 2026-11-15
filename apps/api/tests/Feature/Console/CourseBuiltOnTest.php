<?php

use App\Models\Assignment;
use App\Models\Course;
use App\Models\Material;
use App\Models\SiteSetting;
use App\Models\Test;
use App\Models\User;
use Database\Seeders\ApBiologySeeder;
use Database\Seeders\ApCalculusBcSeeder;
use Database\Seeders\Curriculum\ContentLint;
use Database\Seeders\Curriculum\Course as CourseData;
use Illuminate\Support\Facades\Storage;

// A course built on another (`builds_on`), as AP Calculus BC is built on AB:
// tests/Fixtures/course-built-on reuses tests/Fixtures/course's week 1 and
// unit 1 exam and summary, and adds a week 2 of its own.

beforeEach(function () {
    Storage::fake(config('materials.disk'));
});

function seedBuiltOn(?string $teacher = null, bool $withStudent = true): void
{
    (new ApCalculusBcSeeder(base_path('tests/Fixtures/course-built-on'), $teacher, null, $withStudent))->run();
}

test('seeding it seeds the base course too, and its course row reuses the base rows in its own order', function () {
    seedBuiltOn();

    $teacher = User::where('email', 'apbio@example.com')->sole();
    $base = Course::where('slug', 'apbio')->sole();
    $built = Course::where('slug', 'apbioplus')->sole();
    expect($base->user_id)->toBe($teacher->id)->and($built->user_id)->toBe($teacher->id);

    $slugs = $built->items()->orderBy('position')->get()
        ->map(fn ($item) => $item->test?->slug ?? $item->material?->slug)->all();
    expect($slugs)->toBe([
        'apbio-w01-guide', 'apbio-w01-cards', 'apbio-w01-quiz',
        'apbioplus-w02-guide', 'apbioplus-w02-cards', 'apbioplus-w02-quiz',
        'apbio-u01-summary', 'apbio-u01-exam',
    ]);
    // Reused, not copied: one row per base item.
    expect(Test::where('slug', 'apbio-w01-quiz')->count())->toBe(1)
        ->and(Material::where('slug', 'like', 'apbioplus-%')->count())->toBe(2);
});

test('its student is assigned the reused tests on its own calendar, and the base gets no student', function () {
    seedBuiltOn();

    $student = User::where('email', 'apbioplus-student@example.com')->sole();
    $assigned = Assignment::where('student_id', $student->id)->with('test')->get()->pluck('test.slug')->sort()->values()->all();
    expect($assigned)->toBe(['apbio-u01-exam', 'apbio-w01-quiz', 'apbioplus-w02-quiz'])
        ->and(User::where('email', 'apbio-student@example.com')->exists())->toBeFalse();
});

test('a re-run is idempotent and --teacher moves both courses together', function () {
    seedBuiltOn();
    seedBuiltOn();
    expect(Course::count())->toBe(2)->and(Test::where('slug', 'apbio-w01-quiz')->count())->toBe(1);

    $me = aTeacher(['email' => 'me@example.com']);
    seedBuiltOn('me@example.com', false);
    expect(Course::pluck('user_id')->unique()->all())->toBe([$me->id])
        ->and(Test::whereNotNull('slug')->pluck('user_id')->unique()->all())->toBe([$me->id]);
});

test('it refuses to take the base course from another teacher, before writing anything', function () {
    aTeacher(['email' => 'other@example.com']);
    (new ApBiologySeeder(base_path('tests/Fixtures/course'), 'other@example.com', null, false))->run();
    aTeacher(['email' => 'me@example.com']);

    expect(fn () => seedBuiltOn('me@example.com', false))->toThrow(RuntimeException::class, 'which other@example.com owns');
    expect(Course::where('slug', 'apbioplus')->exists())->toBeFalse()
        ->and(Material::where('slug', 'like', 'apbioplus-%')->exists())->toBeFalse()
        ->and(Test::whereNotNull('slug')->pluck('user_id')->unique()->count())->toBe(1);
});

test('the quota check counts the base course\'s files too, before writing anything', function () {
    // Base: guide, cards, unit summary. This course: week 2 guide and cards.
    SiteSetting::current()->update(['max_materials_per_teacher' => 4]);
    aTeacher(['email' => 'me@example.com']);

    expect(fn () => seedBuiltOn('me@example.com', false))->toThrow(RuntimeException::class, 'needs 5 materials');
    expect(Test::count())->toBe(0)->and(Material::count())->toBe(0);
});

test('the lint counts a reused week\'s base topics as taught, and checks the reuse files', function () {
    $course = new CourseData(base_path('tests/Fixtures/course-built-on'));
    expect($course->topicFirstWeek())->toBe(['1.1' => 1, '1.2' => 2])
        ->and(array_keys($course->ownWeeks()))->toBe([2])
        ->and((new ContentLint($course))->flashcards())->toBe([]);

    $dir = sys_get_temp_dir().'/built-on-'.uniqid();
    exec('cp -r '.escapeshellarg(base_path('tests/Fixtures')).' '.escapeshellarg($dir));
    file_put_contents("{$dir}/course-built-on/unit-01-chemistry-of-life/week-01.yaml", "week: 1\nunit: 1\nreuse: [7]\ntopics: [\"1.1\"]\n");
    $errors = (new ContentLint(new CourseData("{$dir}/course-built-on")))->weeks();
    exec('rm -rf '.escapeshellarg($dir));

    expect(implode("\n", $errors))->toContain('carries no `topics`')->toContain('has no week 7');
});
