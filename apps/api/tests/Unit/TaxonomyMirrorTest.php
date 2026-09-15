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

test('the TypeScript SUBJECTS/GRADE_LEVELS const arrays exactly mirror the PHP enums, in both directions', function () {
    $shared = file_get_contents(base_path('../../packages/shared/src/index.ts'));

    // Extract SUBJECTS array values
    if (preg_match('/export const SUBJECTS:.*?\];/s', $shared, $subjectsMatch)) {
        $subjectsBlock = $subjectsMatch[0];
        preg_match_all('/value:\s*[\'"]([^\'"]+)[\'"]/', $subjectsBlock, $subjectsMatches);
        $tsSubjects = $subjectsMatches[1];
    } else {
        $tsSubjects = [];
    }

    // Extract GRADE_LEVELS array values
    if (preg_match('/export const GRADE_LEVELS:.*?\];/s', $shared, $gradeLevelsMatch)) {
        $gradeLevelsBlock = $gradeLevelsMatch[0];
        preg_match_all('/value:\s*[\'"]([^\'"]+)[\'"]/', $gradeLevelsBlock, $gradeLevelsMatches);
        $tsGradeLevels = $gradeLevelsMatches[1];
    } else {
        $tsGradeLevels = [];
    }

    // Assert parsing found values (not empty)
    expect($tsSubjects)->not->toBeEmpty();
    expect($tsGradeLevels)->not->toBeEmpty();

    // Assert the two lists are identical, not just one-way containment. A
    // value present in the PHP enum (and even in the TS union type) but
    // missing from the TS SUBJECTS/GRADE_LEVELS const array would previously
    // slip through here undetected, even though it would silently vanish
    // from the SPA's checkbox lists and filters.
    $phpSubjects = array_column(Subject::cases(), 'value');
    $phpGradeLevels = array_column(GradeLevel::cases(), 'value');

    expect($tsSubjects)->toBe($phpSubjects);
    expect($tsGradeLevels)->toBe($phpGradeLevels);
});

test('the theme enums (Layout, Palette, Typeset) mirror the shared TypeScript arrays exactly, both directions', function () {
    $shared = file_get_contents(base_path('../../packages/shared/src/index.ts'));

    $pairs = [
        ['LAYOUTS', \App\Enums\Layout::class],
        ['PALETTES', \App\Enums\Palette::class],
        ['TYPESETS', \App\Enums\Typeset::class],
    ];

    foreach ($pairs as [$constName, $enumClass]) {
        // Same regex the SUBJECTS/GRADE_LEVELS test uses: the const must be a
        // TaxonomyOption-shaped array with `value:` keys, or this finds nothing.
        expect(preg_match('/export const '.$constName.':.*?\];/s', $shared, $m))
            ->toBe(1, "$constName const array not found in packages/shared");
        preg_match_all('/value:\s*[\'"]([^\'"]+)[\'"]/', $m[0], $values);

        expect($values[1])->not->toBeEmpty();
        expect($values[1])->toBe(array_column($enumClass::cases(), 'value'));
    }
});
