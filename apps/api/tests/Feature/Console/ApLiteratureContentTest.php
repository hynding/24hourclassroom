<?php

use Database\Seeders\ApLiterature\Course;
use Database\Seeders\ApLiterature\Lint;

/**
 * The content lint for database/seeders/data/ap-literature. The rules live
 * in Database\Seeders\ApLiterature\Lint so an author can run them on one
 * unit at a time; here they run over the whole course and every problem is
 * printed at once.
 */
test('the AP Literature course passes the content lint', function () {
    $problems = (new Lint(new Course(Course::defaultDir())))->run();

    expect($problems)->toBe([], implode("\n", $problems));
});

test('course.yaml names nine units in the CED order, every CED skill and the two accounts', function () {
    $course = new Course(Course::defaultDir());

    expect(array_column($course->config['units'], 'title'))->toBe([
        'Short Fiction I', 'Poetry I', 'Longer Fiction or Drama I',
        'Short Fiction II', 'Poetry II', 'Longer Fiction or Drama II',
        'Short Fiction III', 'Poetry III', 'Longer Fiction or Drama III',
    ])
        ->and(array_keys($course->topics()))->toBe([
            '1.A', '1.B', '1.C', '1.D', '1.E', '2.A', '2.B', '2.C',
            '3.A', '3.B', '3.C', '3.D', '3.E', '3.F', '4.A', '4.B', '4.C', '4.D',
            '5.A', '5.B', '5.C', '5.D', '6.A', '6.B', '6.C', '6.D',
            '7.A', '7.B', '7.C', '7.D', '7.E',
        ])
        ->and($course->config['teacher']['email'])->toBe('aplit@example.com')
        ->and($course->config['student']['email'])->toBe('aplit-student@example.com');
});

test('the lint catches a text too recent to be in the public domain, and a missing source year', function () {
    $dir = sys_get_temp_dir().'/aplit-lint-'.uniqid();
    mkdir("{$dir}/unit-01-short-fiction-i/../guides", 0777, true);
    mkdir("{$dir}/unit-01-short-fiction-i", 0777, true);
    copy(base_path('tests/Fixtures/course-ap-literature/course.yaml'), "{$dir}/course.yaml");
    copy(base_path('tests/Fixtures/course-ap-literature/guides/week-01.md'), "{$dir}/guides/week-01.md");
    $week = file_get_contents(base_path('tests/Fixtures/course-ap-literature/unit-01-short-fiction-i/week-01.yaml'));
    $week = str_replace(['year: 1894', "source: 'Kate Chopin, \"The Story of an Hour\" (1894)'"], ['year: 1937', 'source: Their Eyes Were Watching God'], $week);
    file_put_contents("{$dir}/unit-01-short-fiction-i/week-01.yaml", $week);

    $problems = implode("\n", (new Lint(new Course($dir)))->run([1]));

    expect($problems)->toContain('(1937) is too recent to be in the public domain')
        ->toContain("needs the work's publication year in parentheses");
});
