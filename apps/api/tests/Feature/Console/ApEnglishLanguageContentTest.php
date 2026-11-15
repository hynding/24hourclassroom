<?php

use Database\Seeders\ApEnglishLanguageSeeder;
use Database\Seeders\ApLiterature\Lint;
use Database\Seeders\Curriculum\Course;

/**
 * The content lint for database/seeders/data/ap-english-language: the same
 * Database\Seeders\ApLiterature\Lint as AP Literature, tuned by the `lint`
 * block of the course's course.yaml (exam shape, writing made for the
 * course, U.S. government works, extra text hosts).
 */
test('the AP English Language course passes the content lint', function () {
    $problems = (new Lint(new Course(ApEnglishLanguageSeeder::defaultDir())))->run();

    expect($problems)->toBe([], implode("\n", $problems));
});

test('course.yaml names nine units, the 22 CED skills and the two accounts', function () {
    $course = new Course(ApEnglishLanguageSeeder::defaultDir());

    expect($course->config['units'])->toHaveCount(9)
        ->and(array_merge(...array_map(fn ($u) => $u['weeks'], $course->config['units'])))->toBe(range(1, 32))
        ->and(array_keys($course->topics()))->toBe([
            '1.A', '1.B', '2.A', '2.B', '3.A', '3.B', '3.C', '4.A', '4.B', '4.C',
            '5.A', '5.B', '5.C', '6.A', '6.B', '6.C', '7.A', '7.B', '7.C', '8.A', '8.B', '8.C',
        ])
        ->and($course->config['lint']['practice_exam'])->toBe(['multiple_choice' => 45, 'sets' => 5, 'set_min' => 6, 'set_max' => 13, 'essays' => 3])
        ->and($course->config['teacher']['email'])->toBe('aplang@example.com')
        ->and($course->config['student']['email'])->toBe('aplang-student@example.com');
});

/** A one-week copy of the AP Literature fixture with $lint appended to its course.yaml and $replace applied to its week. */
function englishLintFixture(string $lint, array $replace): string
{
    $from = base_path('tests/Fixtures/course-ap-literature');
    $dir = sys_get_temp_dir().'/aplang-lint-'.uniqid();
    mkdir("{$dir}/guides", 0777, true);
    mkdir("{$dir}/unit-01-short-fiction-i", 0777, true);
    file_put_contents("{$dir}/course.yaml", file_get_contents("{$from}/course.yaml")."\n".$lint);
    copy("{$from}/guides/week-01.md", "{$dir}/guides/week-01.md");
    $week = file_get_contents("{$from}/unit-01-short-fiction-i/week-01.yaml");
    file_put_contents("{$dir}/unit-01-short-fiction-i/week-01.yaml", str_replace(array_keys($replace), array_values($replace), $week));

    return $dir;
}

test('a post-1930 U.S. government work passes only where the course allows it and both the text and the source say so', function () {
    $gov = [
        'year: 1894, url: "https://en.wikisource.org/wiki/The_Story_of_an_Hour" }' => 'year: 1961, url: "https://www.archives.gov/x", us_government_work: true }',
        "source: 'Kate Chopin, \"The Story of an Hour\" (1894)'" => "source: 'John F. Kennedy, Inaugural Address (1961), U.S. government work'",
    ];
    $allowed = "lint:\n  us_government_works: true\n  text_hosts: [www.archives.gov]\n";

    $ok = implode("\n", (new Lint(new Course(englishLintFixture($allowed, $gov))))->run([1]));
    $off = implode("\n", (new Lint(new Course(englishLintFixture('', $gov))))->run([1]));
    $unflagged = implode("\n", (new Lint(new Course(englishLintFixture($allowed, [
        'year: 1894, url: "https://en.wikisource.org/wiki/The_Story_of_an_Hour" }' => 'year: 1961, url: "https://www.archives.gov/x" }',
        "source: 'Kate Chopin, \"The Story of an Hour\" (1894)'" => "source: 'John F. Kennedy, Inaugural Address (1961)'",
    ]))))->run([1]));

    expect($ok)->not->toContain('too recent')->not->toContain('allowed host')
        ->and($off)->toContain('(1961) is too recent to be in the public domain')->toContain('is not an https link to an allowed host')
        ->and($unflagged)->toContain('(1961) is too recent to be in the public domain')->toContain('is too recent to be in the public domain');
});

test('a course\'s original_sources need no year; anything else still does', function () {
    $draft = ["source: 'Kate Chopin, \"The Story of an Hour\" (1894)'" => 'source: written for this course'];

    $allowed = implode("\n", (new Lint(new Course(englishLintFixture("lint:\n  original_sources: [written for this course]\n", $draft))))->run([1]));
    $not = implode("\n", (new Lint(new Course(englishLintFixture('', $draft))))->run([1]));

    expect($allowed)->not->toContain('publication year in parentheses')
        ->and($not)->toContain("source `written for this course` needs the work's publication year in parentheses");
});
