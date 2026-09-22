<?php

use App\Enums\GradeLevel;
use App\Enums\QuestionType;
use App\Enums\Subject;
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
