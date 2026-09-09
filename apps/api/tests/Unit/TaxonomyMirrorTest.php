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
