<?php

use App\Enums\GradeLevel;
use App\Enums\QuestionType;
use App\Enums\Subject;
use App\Mcp\Tools\CreateTestDraft;
use App\Support\QuestionRules;
use App\Support\QuestionShapes;
use App\Support\TaxonomyLabels;
use App\Support\TestDraftSchema;
use App\Support\TestDraftValidator;

test('every question type has a shape entry whose valid example passes and whose invalid example fails', function () {
    $table = QuestionShapes::table();

    foreach (QuestionType::cases() as $type) {
        expect($table)->toHaveKey($type->value);

        $shape = $table[$type->value];
        expect($shape)->toHaveKeys(['options', 'answer', 'extras', 'valid', 'invalid', 'invalid_reason']);
        expect($shape['valid']['type'])->toBe($type->value);
        expect($shape['invalid']['type'])->toBe($type->value);

        // The table is bound to the validator, not to prose: the example a
        // model is shown must be the example the validator accepts.
        expect(QuestionRules::shapeError($shape['valid']))->toBeNull($type->value.' valid example was rejected');
        expect(QuestionRules::shapeError($shape['invalid']))->not->toBeNull($type->value.' invalid example was accepted');
    }
});

test('the valid example of every type survives the draft validator inside a full body', function () {
    $questions = array_values(array_map(
        fn (array $shape) => $shape['valid'],
        QuestionShapes::table(),
    ));

    $data = TestDraftValidator::validate(validDraftBody(['questions' => $questions]));

    expect($data['questions'])->toHaveCount(count(QuestionType::cases()));
    expect(array_column($data['questions'], 'type'))->toBe(array_column(QuestionType::cases(), 'value'));
});

test('the shape table renders as prose naming every type', function () {
    $text = QuestionShapes::text();

    foreach (QuestionType::cases() as $type) {
        expect($text)->toContain($type->value);
    }
});

test('the draft schema requires exactly the four top-level fields', function () {
    expect(TestDraftSchema::json()['required'])->toBe(['title', 'subject', 'grade_level', 'questions']);
});

test('the draft schema never exposes id or visibility', function () {
    $schema = TestDraftSchema::json();

    expect($schema['properties'])->not->toHaveKey('id')->not->toHaveKey('visibility');
    expect(array_keys($schema['properties']))
        ->toBe(['title', 'description', 'subject', 'grade_level', 'questions']);

    // The question item schema is the other half of the rule: a generated
    // draft must never be able to name an existing question row.
    $item = $schema['properties']['questions']['items'];
    expect($item['properties'])->not->toHaveKey('id')->not->toHaveKey('visibility');
    expect($item['required'])->toBe(['type', 'prompt', 'answer']);
});

test('the taxonomy labels mirror the enum cases in order', function () {
    expect(array_column(TaxonomyLabels::subjects(), 'value'))->toBe(array_column(Subject::cases(), 'value'));
    expect(array_column(TaxonomyLabels::gradeLevels(), 'value'))->toBe(array_column(GradeLevel::cases(), 'value'));
    expect(array_column(TaxonomyLabels::questionTypes(), 'value'))->toBe(array_column(QuestionType::cases(), 'value'));

    // Labels are the SPA's, copied: a blank one would render an empty option.
    foreach ([...TaxonomyLabels::subjects(), ...TaxonomyLabels::gradeLevels(), ...TaxonomyLabels::questionTypes()] as $option) {
        expect($option['label'])->toBeString()->not->toBe('');
    }
});

test('the create_test_draft builder schema requires the same four fields as TestDraftSchema', function () {
    // Two hand-written schemas -- the MCP builder's and TestDraftSchema's
    // (C3b's custom tool) -- must agree on what is mandatory, or the two
    // write paths accept different bodies. Only the `required` list and the
    // absence of `id`/`visibility` are compared here: the MCP JsonSchema
    // builder has no way to emit `additionalProperties: false`, so that part
    // of TestDraftSchema's shape is not, and cannot be, asserted against it.
    $builder = (new CreateTestDraft)->toArray()['inputSchema'];

    expect($builder['required'])->toBe(['title', 'subject', 'grade_level', 'questions']);
    expect($builder['required'])->toBe(TestDraftSchema::json()['required']);
    expect($builder['properties'])->not->toHaveKey('id')->not->toHaveKey('visibility');
    expect($builder['properties']['questions']['items']['properties'])
        ->not->toHaveKey('id')
        ->not->toHaveKey('visibility');
});

test('the draft schema states the same length limits as QuestionRules', function () {
    $item = TestDraftSchema::json()['properties']['questions']['items']['properties'];

    expect($item['prompt']['maxLength'])->toBe(QuestionRules::PROMPT_MAX)
        ->and($item['stimulus']['maxLength'])->toBe(QuestionRules::STIMULUS_MAX)
        ->and($item['options']['items']['maxLength'])->toBe(QuestionRules::OPTION_MAX)
        ->and($item['option_explanations']['items']['maxLength'])->toBe(QuestionRules::OPTION_EXPLANATION_MAX)
        ->and($item['explanation']['maxLength'])->toBe(QuestionRules::EXPLANATION_MAX);

    // And the field rules read the same constants.
    $rules = QuestionRules::rules();
    expect($rules['questions.*.prompt'])->toContain('max:'.QuestionRules::PROMPT_MAX)
        ->and($rules['questions.*.options.*'])->toContain('max:'.QuestionRules::OPTION_MAX)
        ->and($rules['questions.*.explanation'])->toContain('max:'.QuestionRules::EXPLANATION_MAX);
});

test('the hand-grading allowlist is exactly the three written types', function () {
    // Which of these the grader leaves null is bound in AttemptGraderTest.
    expect(array_values(array_map(fn ($t) => $t->value, array_filter(QuestionType::cases(), fn ($t) => $t->allowsManualGrade()))))
        ->toBe(['short_answer', 'fill_blank', 'long_answer']);
});

test('the generation prompt rules name every type in the right options list and the long-answer points range', function () {
    $prompt = view('generation.system')->render();

    expect(preg_match('/`options` is required for (.+?),\s+and must be omitted for ([^.]+)\./s', $prompt, $m))
        ->toBe(1, 'options rule not found in the generation prompt');
    $split = fn (string $list) => array_map('trim', preg_split('/,| and /', $list));
    $required = $split($m[1]);
    $omitted = $split($m[2]);

    foreach (QuestionType::cases() as $type) {
        expect(in_array($type->value, $type->hasOptions() ? $required : $omitted, true))->toBeTrue($type->value);
    }
    expect(count($required) + count($omitted))->toBe(count(QuestionType::cases()));

    expect($prompt)->toContain(
        'long_answer is always worth '.QuestionRules::LONG_ANSWER_POINTS_MIN.' to '.QuestionRules::LONG_ANSWER_POINTS_MAX.' points'
    );
});
