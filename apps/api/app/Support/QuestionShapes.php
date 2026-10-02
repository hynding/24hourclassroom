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
     * Two keys are common to every type and described once here rather than
     * per row: `stimulus` (optional text shared by a set of consecutive
     * questions -- a passage or data table, repeated verbatim on each) and
     * `explanation` (optional; on the hand-graded types it is the summary
     * of acceptable answers a grader works from).
     *
     * @return array<string, array{options: string, answer: string, extras: string, valid: array<string, mixed>, invalid: array<string, mixed>, invalid_reason: string}>
     */
    public static function table(): array
    {
        return [
            QuestionType::MultipleChoice->value => [
                'options' => 'Required: a list of 2 to 8 non-empty strings.',
                'answer' => 'The 0-based integer index of the one correct option.',
                'extras' => 'points is an integer 1-100 (default 1); explanation is optional; option_explanations is an optional list parallel to options saying why each is right or wrong; stimulus is optional shared context.',
                'valid' => [
                    'type' => 'multiple_choice',
                    'stimulus' => 'Three fractions were written on the board: 1/4, 1/2 and 3/4.',
                    'prompt' => 'Which fraction is largest?',
                    'options' => ['1/4', '1/2', '3/4'],
                    'option_explanations' => ['Smallest numerator over the largest denominator.', 'Half is less than three quarters.', 'Correct: three of four equal parts.'],
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
                'extras' => 'partial_credit may be true on this type and no other; option_explanations as for multiple_choice.',
                'valid' => [
                    'type' => 'multi_select',
                    'prompt' => 'Which of these are greater than one half?',
                    'options' => ['1/3', '2/3', '3/4'],
                    'option_explanations' => ['One third is below one half.', 'Correct: two thirds is above one half.', 'Correct: three quarters is above one half.'],
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
            QuestionType::FillBlank->value => [
                'options' => 'None: omit the key entirely.',
                'answer' => 'A list of 1 to 10 distinct accepted strings; the first is the canonical answer, the rest are accepted alternatives.',
                'extras' => 'prompt must contain the blank marker ____. Graded automatically by normalized exact match (case, outer and repeated whitespace, one trailing full stop ignored) unless auto_grade is false, in which case a teacher grades it by hand. explanation should give the reasoning for the term.',
                'valid' => [
                    'type' => 'fill_blank',
                    'prompt' => 'One half plus one quarter equals ____.',
                    'answer' => ['3/4', 'three quarters'],
                    'explanation' => 'Rewrite one half as two quarters, then add.',
                ],
                'invalid' => [
                    'type' => 'fill_blank',
                    'prompt' => 'One half plus one quarter equals ____.',
                    'answer' => '3/4',
                ],
                'invalid_reason' => 'The answer is a single string instead of a list of accepted strings.',
            ],
            QuestionType::LongAnswer->value => [
                'options' => 'None: omit the key entirely.',
                'answer' => 'A non-empty string: a short model answer.',
                'extras' => 'points is an integer 4-10. Always graded by hand; explanation must summarise the acceptable answers point by point.',
                'valid' => [
                    'type' => 'long_answer',
                    'prompt' => 'Explain why one half is greater than one third, using a drawing you describe in words.',
                    'answer' => 'Halves are two equal parts of a whole, thirds are three; each half is larger than each third.',
                    'points' => 6,
                    'explanation' => 'Full credit: equal parts of the same whole (2 pts), fewer parts means larger parts (2 pts), a described drawing that shows it (2 pts).',
                ],
                'invalid' => [
                    'type' => 'long_answer',
                    'prompt' => 'Explain why one half is greater than one third.',
                    'answer' => 'Halves are bigger than thirds.',
                    'points' => 2,
                ],
                'invalid_reason' => 'Two points is below the four-point minimum for a long answer.',
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
