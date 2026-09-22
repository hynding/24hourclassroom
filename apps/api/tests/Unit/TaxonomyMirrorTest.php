<?php

use App\Enums\GradeLevel;
use App\Enums\Subject;
use App\Support\TaxonomyLabels;

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

use App\Enums\QuestionType;
use App\Enums\Visibility;

test('Visibility and QuestionType mirror the shared package in both directions', function () {
    $shared = file_get_contents(base_path('../../packages/shared/src/index.ts'));

    foreach ([Visibility::class => 'VISIBILITIES', QuestionType::class => 'QUESTION_TYPES'] as $enum => $const) {
        $php = array_column($enum::cases(), 'value');
        expect(preg_match('/export const '.$const.':.*?\];/s', $shared, $m))->toBe(1, "$const const array not found in packages/shared");
        preg_match_all('/value:\s*[\'"]([^\'"]+)[\'"]/', $m[0], $found);
        expect($found[1])->toBe($php);
    }

    expect(array_column(QuestionType::cases(), 'value'))->toBe([
        'multiple_choice', 'multi_select', 'true_false', 'short_answer', 'numeric',
    ]);
    expect(array_column(Visibility::cases(), 'value'))->toBe(['private', 'public']);
});

test('the old TestVisibility names are gone from both sides', function () {
    // Guards the rename itself: a stale import or a leftover TEST_VISIBILITIES
    // const would otherwise keep working for one side and rot.
    expect(class_exists(\App\Enums\TestVisibility::class))->toBeFalse();
    $shared = file_get_contents(base_path('../../packages/shared/src/index.ts'));
    expect($shared)->not->toContain('TestVisibility')->not->toContain('TEST_VISIBILITIES');
});

test('TaxonomyLabels labels mirror the shared TypeScript const arrays, in order', function () {
    // TaxonomyLabels is a hand-copy of @24hc/shared's labels (see its class
    // docblock); this asserts the copy hasn't drifted, the same block regex
    // the value-only tests above use, plus a `label:` capture.
    $shared = file_get_contents(base_path('../../packages/shared/src/index.ts'));

    $pairs = [
        ['SUBJECTS', TaxonomyLabels::subjects()],
        ['GRADE_LEVELS', TaxonomyLabels::gradeLevels()],
        ['QUESTION_TYPES', TaxonomyLabels::questionTypes()],
    ];

    foreach ($pairs as [$constName, $phpEntries]) {
        expect(preg_match('/export const '.$constName.':.*?\];/s', $shared, $m))
            ->toBe(1, "$constName const array not found in packages/shared");
        preg_match_all('/label:\s*[\'"]([^\'"]+)[\'"]/', $m[0], $labels);

        expect($labels[1])->not->toBeEmpty();
        expect($labels[1])->toBe(array_column($phpEntries, 'label'));
    }
});

test('the per-file upload cap in config/materials.php mirrors MAX_MATERIAL_BYTES', function () {
    // The SPA's pre-flight size check and the server's `max:` rule have to
    // agree or a user sees one limit and hits another. The TS side is a
    // LITERAL (not 10 * 1024 * 1024) so this digit-capturing regex can read
    // it the same way the enum tests read `value:` entries.
    $shared = file_get_contents(base_path('../../packages/shared/src/index.ts'));

    expect(preg_match('/export const MAX_MATERIAL_BYTES\s*=\s*(\d+);/', $shared, $m))
        ->toBe(1, 'MAX_MATERIAL_BYTES literal not found in packages/shared');
    expect((int) $m[1])->toBe(config('materials.max_file_kb') * 1024);
    expect((int) $m[1])->toBe(10485760);
});

use App\Enums\GenerationStatus;

test('GenerationStatus mirrors the shared GENERATION_STATUSES array in both directions', function () {
    // Same regex as the VISIBILITIES/QUESTION_TYPES test: the const must be a
    // TaxonomyOption-shaped array with `value:` keys, or this finds nothing.
    $shared = file_get_contents(base_path('../../packages/shared/src/index.ts'));

    expect(preg_match('/export const GENERATION_STATUSES:.*?\];/s', $shared, $m))
        ->toBe(1, 'GENERATION_STATUSES const array not found in packages/shared');
    preg_match_all('/value:\s*[\'"]([^\'"]+)[\'"]/', $m[0], $found);

    expect($found[1])->not->toBeEmpty();
    expect($found[1])->toBe(array_column(GenerationStatus::cases(), 'value'));
});

test('the generation limits in config/generation.php mirror the shared literals', function () {
    // The SPA enforces min/max questions and the ≤5 material cap in its own
    // form, and prints the budget in a message the server also composes, so
    // both sides have to read the same numbers. The TS side is four LITERALS
    // (no type annotation, no arithmetic) so this digit-capturing regex can
    // read them the way the MAX_MATERIAL_BYTES test does.
    $shared = file_get_contents(base_path('../../packages/shared/src/index.ts'));

    $pairs = [
        'GENERATION_BUDGET_CENTS' => 'generation.budget_cents',
        'GENERATION_MAX_MATERIALS' => 'generation.max_materials',
        'GENERATION_MIN_QUESTIONS' => 'generation.min_questions',
        'GENERATION_MAX_QUESTIONS' => 'generation.max_questions',
    ];

    foreach ($pairs as $const => $key) {
        expect(preg_match('/export const '.$const.'\s*=\s*(\d+);/', $shared, $m))
            ->toBe(1, "$const literal not found in packages/shared");
        expect((int) $m[1])->toBe(config($key));
    }

    expect(config('generation.budget_cents'))->toBe(200);
    expect(config('generation.max_materials'))->toBe(5);
    expect(config('generation.min_questions'))->toBe(5);
    expect(config('generation.max_questions'))->toBe(30);
});
