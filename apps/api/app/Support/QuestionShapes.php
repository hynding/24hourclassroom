<?php

namespace App\Support;

use App\Enums\QuestionType;

/**
 * The ONE shape table. Three consumers read it: list_taxonomies (as data),
 * C3b's system prompt (as prose, via text()), and QuestionShapesTest, which
 * binds every example to QuestionRules::shapeError -- so the table cannot
 * drift from the validator without a red test.
 */
final class QuestionShapes
{
    /**
     * Keyed by QuestionType value, in enum order.
     *
     * @return array<string, array{options: string, answer: string, extras: string, valid: array<string, mixed>, invalid: array<string, mixed>, invalid_reason: string}>
     */
    public static function table(): array
    {
        return [
            QuestionType::MultipleChoice->value => [
                'options' => 'Required: a list of 2 to 8 non-empty strings.',
                'answer' => 'The 0-based integer index of the one correct option.',
                'extras' => 'points is an integer 1-100 (default 1); explanation is optional.',
                'valid' => [
                    'type' => 'multiple_choice',
                    'prompt' => 'Which fraction is largest?',
                    'options' => ['1/4', '1/2', '3/4'],
                    'answer' => 2,
                    'points' => 2,
                    'explanation' => 'Three quarters is the largest of the three.',
                ],
                'invalid' => [
                    'type' => 'multiple_choice',
                    'prompt' => 'Which fraction is largest?',
                    'options' => ['1/4', '1/2', '3/4'],
                    'answer' => 3,
                ],
                'invalid_reason' => 'The answer index is past the end of the options list.',
            ],
            QuestionType::MultiSelect->value => [
                'options' => 'Required: a list of 2 to 8 non-empty strings.',
                'answer' => 'A non-empty list of distinct 0-based integer indices.',
                'extras' => 'partial_credit may be true on this type and no other.',
                'valid' => [
                    'type' => 'multi_select',
                    'prompt' => 'Which of these are greater than one half?',
                    'options' => ['1/3', '2/3', '3/4'],
                    'answer' => [1, 2],
                    'partial_credit' => true,
                ],
                'invalid' => [
                    'type' => 'multi_select',
                    'prompt' => 'Which of these are greater than one half?',
                    'options' => ['1/3', '2/3', '3/4'],
                    'answer' => [1, 1],
                ],
                'invalid_reason' => 'The answer repeats an option index.',
            ],
            QuestionType::TrueFalse->value => [
                'options' => 'None: omit the key entirely.',
                'answer' => 'The boolean true or false.',
                'extras' => 'explanation is optional.',
                'valid' => [
                    'type' => 'true_false',
                    'prompt' => 'One half is greater than one third.',
                    'answer' => true,
                ],
                'invalid' => [
                    'type' => 'true_false',
                    'prompt' => 'One half is greater than one third.',
                    'answer' => 'true',
                ],
                'invalid_reason' => 'The answer is the string "true" instead of a boolean.',
            ],
            QuestionType::ShortAnswer->value => [
                'options' => 'None: omit the key entirely.',
                'answer' => 'A non-empty string: the expected answer.',
                'extras' => 'explanation is optional.',
                'valid' => [
                    'type' => 'short_answer',
                    'prompt' => 'Name a unit fraction.',
                    'answer' => '1/2',
                ],
                'invalid' => [
                    'type' => 'short_answer',
                    'prompt' => 'Name a unit fraction.',
                    'answer' => '',
                ],
                'invalid_reason' => 'The expected answer is empty.',
            ],
            QuestionType::Numeric->value => [
                'options' => 'None: omit the key entirely.',
                'answer' => 'An object {value, tolerance}: value is a number, tolerance is an optional number >= 0.',
                'extras' => 'points is an integer 1-100 (default 1).',
                'valid' => [
                    'type' => 'numeric',
                    'prompt' => 'What is 0.5 times 4?',
                    'answer' => ['value' => 2, 'tolerance' => 0],
                ],
                'invalid' => [
                    'type' => 'numeric',
                    'prompt' => 'What is 0.5 times 4?',
                    'answer' => ['value' => 2, 'tolerance' => -1],
                ],
                'invalid_reason' => 'A negative tolerance.',
            ],
        ];
    }

    /** The same table as plain prose, for the generation system prompt. */
    public static function text(): string
    {
        $lines = [];

        foreach (self::table() as $type => $shape) {
            $lines[] = $type;
            $lines[] = '  options: '.$shape['options'];
            $lines[] = '  answer: '.$shape['answer'];
            $lines[] = '  extras: '.$shape['extras'];
            $lines[] = '  accepted: '.json_encode($shape['valid'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            $lines[] = '  rejected: '.json_encode($shape['invalid'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
                .' -- '.$shape['invalid_reason'];
            $lines[] = '';
        }

        return trim(implode("\n", $lines));
    }
}
