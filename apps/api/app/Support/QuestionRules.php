<?php

namespace App\Support;

use App\Enums\QuestionType;
use Illuminate\Validation\Rule;

final class QuestionRules
{
    /** Field-level rules; the per-type shape is checked by shapeError(). */
    public static function rules(): array
    {
        return [
            'questions' => ['required', 'array', 'min:1', 'max:100'],
            'questions.*.id' => ['nullable', 'integer'],
            'questions.*.type' => ['required', Rule::enum(QuestionType::class)],
            'questions.*.prompt' => ['required', 'string', 'max:2000'],
            'questions.*.options' => ['nullable', 'array', 'min:2', 'max:8'],
            'questions.*.options.*' => ['string', 'max:200'],
            'questions.*.answer' => ['present'],
            'questions.*.points' => ['nullable', 'integer', 'min:1', 'max:100'],
            'questions.*.partial_credit' => ['nullable', 'boolean'],
            'questions.*.explanation' => ['nullable', 'string', 'max:2000'],
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
        } elseif ($options !== null) {
            return 'This question type does not take options.';
        }

        if (($q['partial_credit'] ?? false) && $type !== QuestionType::MultiSelect) {
            return 'Partial credit applies to select-all questions only.';
        }

        $count = is_array($options) ? count($options) : 0;
        $isIndex = fn ($i) => is_int($i) && $i >= 0 && $i < $count;
        $isNumber = fn ($n) => is_int($n) || is_float($n);

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
            QuestionType::ShortAnswer => (is_string($answer) && trim($answer) !== '') ? null : 'The answer must be a non-empty expected answer.',
            QuestionType::Numeric => (
                is_array($answer)
                && array_diff(array_keys($answer), ['value', 'tolerance']) === []
                && array_key_exists('value', $answer) && $isNumber($answer['value'])
                && (! array_key_exists('tolerance', $answer) || ($isNumber($answer['tolerance']) && $answer['tolerance'] >= 0))
            ) ? null : 'The answer must be {value, tolerance >= 0}.',
        };
    }
}
