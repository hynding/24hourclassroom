<?php

namespace App\Support;

use App\Enums\QuestionType;
use Illuminate\Validation\Rule;

final class QuestionRules
{
    /**
     * The length limits, in ONE place. TestDraftSchema and the
     * create_test_draft MCP tool read these; QuestionShapesTest asserts
     * the draft schema's maxLengths equal them.
     */
    public const PROMPT_MAX = 4000;

    public const STIMULUS_MAX = 4000;

    public const OPTION_MAX = 500;

    public const OPTION_EXPLANATION_MAX = 600;

    public const EXPLANATION_MAX = 5000;

    /** short_answer and long_answer model answers. */
    public const TEXT_ANSWER_MAX = 2000;

    /** fill_blank: at most this many accepted strings, each at most this long. */
    public const BLANK_ANSWERS_MAX = 10;

    public const BLANK_ANSWER_MAX = 100;

    /** long_answer points, inclusive. */
    public const LONG_ANSWER_POINTS_MIN = 4;

    public const LONG_ANSWER_POINTS_MAX = 10;

    /** The blank marker a fill_blank prompt must contain. */
    public const BLANK = '____';

    /** Field-level rules; the per-type shape is checked by shapeError(). */
    public static function rules(): array
    {
        return [
            'questions' => ['required', 'array', 'min:1', 'max:100'],
            'questions.*.id' => ['nullable', 'integer'],
            'questions.*.type' => ['required', Rule::enum(QuestionType::class)],
            'questions.*.prompt' => ['required', 'string', 'max:'.self::PROMPT_MAX],
            'questions.*.stimulus' => ['nullable', 'string', 'max:'.self::STIMULUS_MAX],
            'questions.*.options' => ['nullable', 'array', 'min:2', 'max:8'],
            'questions.*.options.*' => ['string', 'max:'.self::OPTION_MAX],
            'questions.*.option_explanations' => ['nullable', 'array', 'max:8'],
            'questions.*.option_explanations.*' => ['nullable', 'string', 'max:'.self::OPTION_EXPLANATION_MAX],
            'questions.*.answer' => ['present'],
            'questions.*.points' => ['nullable', 'integer', 'min:1', 'max:100'],
            'questions.*.partial_credit' => ['nullable', 'boolean'],
            'questions.*.auto_grade' => ['nullable', 'boolean'],
            'questions.*.explanation' => ['nullable', 'string', 'max:'.self::EXPLANATION_MAX],
        ];
    }

    /**
     * Null when the question's options/answer match its type; otherwise the
     * message to attach to `questions.{i}`.
     */
    public static function shapeError(array $q): ?string
    {
        $type = QuestionType::tryFrom((string) ($q['type'] ?? ''));
        if ($type === null) {
            return null; // Rule::enum already reported it.
        }

        $options = $q['options'] ?? null;
        $answer = $q['answer'] ?? null;
        $rationales = $q['option_explanations'] ?? null;

        if ($type->hasOptions()) {
            if (! is_array($options) || count($options) < 2 || count($options) > 8) {
                return 'This question type needs between 2 and 8 options.';
            }
            // TestWriter array_values() the options, so an associative object
            // ({"1":"a","0":"b"}) would be silently re-ordered and the answer
            // index would then point at a DIFFERENT option than the author
            // sent. Reject the shape instead of storing a wrong answer key.
            if (! array_is_list($options)) {
                return 'Options must be a list.';
            }
            foreach ($options as $option) {
                if (! is_string($option) || trim($option) === '') {
                    return 'Every option must be a non-empty string.';
                }
            }
            // The rationales are parallel to the options: same length, same
            // order, a string (possibly empty) per option.
            if ($rationales !== null) {
                if (! is_array($rationales) || ! array_is_list($rationales) || count($rationales) !== count($options)) {
                    return 'Option explanations must be a list with one entry per option.';
                }
                foreach ($rationales as $rationale) {
                    if ($rationale !== null && ! is_string($rationale)) {
                        return 'Every option explanation must be a string.';
                    }
                }
            }
        } elseif ($options !== null) {
            return 'This question type does not take options.';
        } elseif ($rationales !== null) {
            return 'This question type does not take option explanations.';
        }

        if (($q['partial_credit'] ?? false) && $type !== QuestionType::MultiSelect) {
            return 'Partial credit applies to select-all questions only.';
        }

        if (array_key_exists('auto_grade', $q) && $q['auto_grade'] === false && $type !== QuestionType::FillBlank) {
            return 'Only fill-in-the-blank questions can switch off automatic grading.';
        }

        if ($type === QuestionType::LongAnswer) {
            $points = $q['points'] ?? 1;
            if (! is_int($points) || $points < self::LONG_ANSWER_POINTS_MIN || $points > self::LONG_ANSWER_POINTS_MAX) {
                return sprintf('A long answer is worth between %d and %d points.', self::LONG_ANSWER_POINTS_MIN, self::LONG_ANSWER_POINTS_MAX);
            }
        }

        if ($type === QuestionType::FillBlank && ! str_contains((string) ($q['prompt'] ?? ''), self::BLANK)) {
            return 'A fill-in-the-blank prompt must contain the blank marker '.self::BLANK.'.';
        }

        $count = is_array($options) ? count($options) : 0;
        $isIndex = fn ($i) => is_int($i) && $i >= 0 && $i < $count;
        $isNumber = fn ($n) => is_int($n) || is_float($n);
        $isText = fn ($s, int $max) => is_string($s) && trim($s) !== '' && mb_strlen($s) <= $max;

        return match ($type) {
            QuestionType::MultipleChoice => $isIndex($answer) ? null : 'The answer must be the index of one option.',
            QuestionType::MultiSelect => (
                is_array($answer)
                && $answer !== []
                && array_is_list($answer)
                && count($answer) === count(array_unique($answer))
                && array_reduce($answer, fn ($ok, $i) => $ok && $isIndex($i), true)
            ) ? null : 'The answer must be a non-empty list of distinct option indices.',
            QuestionType::TrueFalse => is_bool($answer) ? null : 'The answer must be true or false.',
            QuestionType::ShortAnswer, QuestionType::LongAnswer => $isText($answer, self::TEXT_ANSWER_MAX)
                ? null
                : sprintf('The answer must be a non-empty expected answer of at most %d characters.', self::TEXT_ANSWER_MAX),
            QuestionType::Numeric => (
                is_array($answer)
                && array_diff(array_keys($answer), ['value', 'tolerance']) === []
                && array_key_exists('value', $answer) && $isNumber($answer['value'])
                && (! array_key_exists('tolerance', $answer) || ($isNumber($answer['tolerance']) && $answer['tolerance'] >= 0))
            ) ? null : 'The answer must be {value, tolerance >= 0}.',
            QuestionType::FillBlank => (
                is_array($answer)
                && $answer !== []
                && array_is_list($answer)
                && count($answer) <= self::BLANK_ANSWERS_MAX
                && array_reduce($answer, fn ($ok, $s) => $ok && $isText($s, self::BLANK_ANSWER_MAX), true)
                && count($answer) === count(array_unique(array_map('trim', $answer)))
            ) ? null : sprintf('The answer must be a list of 1 to %d distinct accepted strings.', self::BLANK_ANSWERS_MAX),
        };
    }
}
