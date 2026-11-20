<?php

use App\Models\Material;
use App\Models\Test;
use Database\Seeders\ApBiologySeeder;
use Database\Seeders\Curriculum\ContentLint;
use Database\Seeders\Curriculum\Course;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Yaml;

/*
 * Per-course settings in course.yaml that an elementary course needs:
 * `labels:` (its own words for generated titles), `lint:` (its own content
 * sizes) and `topics_are_standards:` (topic codes tag what is seeded).
 * Each runs on a copy of the fixture course with the setting added.
 */
beforeEach(function () {
    Storage::fake(config('materials.disk'));
});

/** A temporary copy of the fixture course with extra course.yaml keys. @param array<string, mixed> $extra */
function fixtureCourseWith(array $extra): string
{
    $dir = sys_get_temp_dir().'/course-settings-'.uniqid();
    File::copyDirectory(base_path('tests/Fixtures/course'), $dir);
    $config = Yaml::parseFile("{$dir}/course.yaml");
    file_put_contents("{$dir}/course.yaml", Yaml::dump(array_replace($config, $extra), 6));

    return $dir;
}

afterEach(function () {
    foreach (glob(sys_get_temp_dir().'/course-settings-*') as $dir) {
        File::deleteDirectory($dir);
    }
});

test('without the settings, titles and descriptions keep the AP wording and nothing is tagged', function () {
    (new ApBiologySeeder(base_path('tests/Fixtures/course')))->run();

    expect(Test::where('slug', 'apbio-u01-exam')->sole()->title)->toContain('Unit 1 Exam')
        ->and(Test::where('slug', 'apbio-w01-quiz')->sole()->standards)->toBeNull()
        ->and(Material::where('slug', 'apbio-w01-guide')->sole()->standards)->toBeNull();
});

test('labels rename the generated titles and descriptions', function () {
    $course = new Course(fixtureCourseWith(['labels' => [
        'topics' => 'Standards', 'unit_exam' => 'Unit Check', 'practice_exam' => 'End-of-Year Check',
        'prep_guide' => 'Year Review Guide', 'review_section' => 'Year review',
    ]]));

    expect($course->unitExamTitle(1))->toBe('AP Biology · Week 02 · Unit 1 Unit Check · Chemistry of Life')
        ->and($course->practiceExamTitle())->toBe('AP Biology · Week 34 · End-of-Year Check')
        ->and($course->examPrepTitle())->toBe('AP Biology · Week 33 · Year Review Guide')
        ->and($course->sectionTitle(null))->toBe('Year review')
        ->and($course->describe(['1.1'], 'Water.', 1))->toBe("Standards 1.1 · Unit 1 Chemistry of Life\n\nWater.");
});

test('topics_are_standards tags every seeded test and material with its codes', function () {
    (new ApBiologySeeder(fixtureCourseWith(['topics_are_standards' => true])))->run();

    expect(Test::where('slug', 'apbio-w01-quiz')->sole()->standards)->toBe(['1.1'])
        ->and(Test::where('slug', 'apbio-u01-exam')->sole()->standards)->not->toBeEmpty()
        ->and(Material::where('slug', 'apbio-w01-guide')->sole()->standards)->toBe(['1.1'])
        ->and(Material::where('slug', 'apbio-w01-cards')->sole()->standards)->toBe(['1.1'])
        ->and(Material::where('slug', 'apbio-u01-summary')->sole()->standards)->toBe(['1.1', '1.2']);
});

test('lint settings change the sizes the content lint asks for', function () {
    $default = new ContentLint(new Course(base_path('tests/Fixtures/course')));
    $tuned = new ContentLint(new Course(fixtureCourseWith(['lint' => [
        'cards' => [1, 3], 'quiz_items' => [1, 3], 'guide_min_words' => 10, 'unit_exam_items' => [1, 3],
        'unit_exam_needs' => [], 'unit_exam_stimulus_sets' => 0,
    ]])));

    expect(implode("\n", $default->weeks()))->toContain('(want 20-25)')
        ->and(implode("\n", $tuned->weeks()))->not->toContain('quiz questions')
        ->and(implode("\n", $tuned->weeks()))->not->toContain(' cards (')
        ->and(implode("\n", $default->unitExams()))->toContain('(want 40-50)')
        ->and($tuned->unitExams())->toBe([]);
});

test('figures_per_test asks every test for that many pictures, and is off by default', function () {
    $dir = fixtureCourseWith(['lint' => ['figures_per_test' => 1]]);

    expect((new ContentLint(new Course(base_path('tests/Fixtures/course'))))->figures())->toBe([])
        ->and(implode("\n", (new ContentLint(new Course($dir)))->figures()))
        ->not->toContain('week-01.yaml')
        ->toContain('unit-exam.yaml');
});
