<?php

use App\Enums\GradeLevel;
use App\Enums\Subject;

test('every PHP taxonomy value appears in the shared TypeScript package', function () {
    $shared = file_get_contents(base_path('../../packages/shared/src/index.ts'));

    foreach (Subject::cases() as $case) {
        expect($shared)->toContain("'{$case->value}'");
    }

    foreach (GradeLevel::cases() as $case) {
        expect($shared)->toContain("'{$case->value}'");
    }
});

test('the taxonomy has the exact curated membership the spec calls for', function () {
    expect(array_column(Subject::cases(), 'value'))->toBe([
        'math', 'science', 'english-language-arts', 'social-studies', 'art',
        'music', 'pe', 'world-languages', 'computer-science', 'special-education', 'other',
    ]);

    expect(array_column(GradeLevel::cases(), 'value'))->toBe([
        'k-2', '3-5', '6-8', '9-12', 'higher-ed',
    ]);
});

test('every TypeScript taxonomy value has a matching PHP enum case', function () {
    $shared = file_get_contents(base_path('../../packages/shared/src/index.ts'));

    // Extract SUBJECTS array values
    if (preg_match('/export const SUBJECTS:.*?\];/s', $shared, $subjectsMatch)) {
        $subjectsBlock = $subjectsMatch[0];
        preg_match_all("/value:\s*'([^']+)'/", $subjectsBlock, $subjectsMatches);
        $tsSubjects = $subjectsMatches[1];
    } else {
        $tsSubjects = [];
    }

    // Extract GRADE_LEVELS array values
    if (preg_match('/export const GRADE_LEVELS:.*?\];/s', $shared, $gradeLevelsMatch)) {
        $gradeLevelsBlock = $gradeLevelsMatch[0];
        preg_match_all("/value:\s*'([^']+)'/", $gradeLevelsBlock, $gradeLevelsMatches);
        $tsGradeLevels = $gradeLevelsMatches[1];
    } else {
        $tsGradeLevels = [];
    }

    // Assert parsing found values (not empty)
    expect($tsSubjects)->not->toBeEmpty();
    expect($tsGradeLevels)->not->toBeEmpty();

    // Assert every TS value exists in PHP enums
    $phpSubjects = array_column(Subject::cases(), 'value');
    $phpGradeLevels = array_column(GradeLevel::cases(), 'value');

    foreach ($tsSubjects as $value) {
        expect($phpSubjects)->toContain($value);
    }

    foreach ($tsGradeLevels as $value) {
        expect($phpGradeLevels)->toContain($value);
    }
});
