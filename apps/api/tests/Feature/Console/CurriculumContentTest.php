<?php

use Database\Seeders\Algebra1Seeder;
use Database\Seeders\Algebra2Seeder;
use Database\Seeders\ApBiologySeeder;
use Database\Seeders\ApUsHistorySeeder;
use Database\Seeders\GeometrySeeder;
use Database\Seeders\Curriculum\ContentLint;
use Database\Seeders\Curriculum\Course;

/**
 * The content lint for every seeded course under database/seeders/data.
 * The rules live in ContentLint (provenance, rationale quality, spiral
 * review, duplicates, attribution) so an author can run them on a draft;
 * here each one must come back empty for every course.
 */
dataset('seeded courses', [
    'AP Biology' => [ApBiologySeeder::class, ['units' => 8, 'topics' => ['1.1', '2.10', '3.5', '4.6', '5.5', '6.8', '7.12', '8.7'], 'email' => 'apbio@example.com', 'student' => 'apbio-student@example.com']],
    'AP U.S. History' => [ApUsHistorySeeder::class, ['units' => 9, 'topics' => ['1.7', '2.8', '3.13', '4.14', '5.12', '6.14', '7.15', '8.15', '9.7'], 'email' => 'apush@example.com', 'student' => 'apush-student@example.com']],
    // The math courses' topic codes are IM 9-12 lesson numbers; every unit has a lesson 1.
    'Algebra 1' => [Algebra1Seeder::class, ['units' => 7, 'topics' => ['1.1', '2.1', '3.1', '4.1', '5.1', '6.1', '7.1'], 'email' => 'algebra1@example.com', 'student' => 'algebra1-student@example.com']],
    'Geometry' => [GeometrySeeder::class, ['units' => 8, 'topics' => ['1.1', '2.1', '3.1', '4.1', '5.1', '6.1', '7.1', '8.1'], 'email' => 'geometry@example.com', 'student' => 'geometry-student@example.com']],
    'Algebra 2' => [Algebra2Seeder::class, ['units' => 7, 'topics' => ['1.1', '2.1', '3.1', '4.1', '5.1', '6.1', '7.1'], 'email' => 'algebra2@example.com', 'student' => 'algebra2-student@example.com']],
]);

test('course.yaml names its units with the CED topic codes, its slug and the two accounts', function (string $seeder, array $expect) {
    $course = new Course($seeder::defaultDir());
    expect(count($course->config['units']))->toBe($expect['units'])
        ->and(array_keys($course->topics()))->toContain(...$expect['topics'])
        ->and($course->slug)->toBe($seeder::COURSE_SLUG)
        ->and($course->config['teacher']['email'])->toBe($expect['email'])
        ->and($course->config['student']['email'])->toBe($expect['student']);
})->with('seeded courses');

test('the content lint passes', function (string $seeder, array $expect, string $rule) {
    $errors = (new ContentLint(new Course($seeder::defaultDir())))->{$rule}();
    expect($errors)->toBe([], implode("\n", array_slice($errors, 0, 25)));
})->with('seeded courses')->with(ContentLint::RULES);

test('the course fits the default per-teacher file cap', function (string $seeder) {
    $course = new Course($seeder::defaultDir());
    $files = 2 * count($course->weeks()) + count($course->unitSummaries()) + ($course->examPrepGuide() ? 1 : 0);
    expect($files)->toBeLessThanOrEqual(100, "{$files} materials");
})->with('seeded courses');

test('no two seeded courses share a slug', function () {
    $slugs = array_map(fn ($seeder) => (new Course($seeder::defaultDir()))->slug, [ApBiologySeeder::class, ApUsHistorySeeder::class, Algebra1Seeder::class, GeometrySeeder::class, Algebra2Seeder::class]);
    expect(array_unique($slugs))->toHaveCount(count($slugs));
});
