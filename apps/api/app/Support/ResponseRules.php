<?php

namespace App\Support;

/**
 * The `responses` body of every endpoint that takes a student's answers:
 * saving an attempt, and checking a practice run. A long_answer textarea
 * invites a paste of any size, so the text shapes are capped here, where
 * every response lands. Other shapes (indices, booleans, numbers) are
 * bounded by their type.
 */
final class ResponseRules
{
    public const MAX = 10000;

    /** @return array<string, array<int, mixed>> */
    public static function rules(): array
    {
        return [
            'responses' => ['present', 'array'],
            'responses.*' => [function (string $attribute, mixed $value, \Closure $fail) {
                if (is_string($value) && mb_strlen($value) > self::MAX) {
                    $fail('A written response may be at most '.self::MAX.' characters.');
                }
            }],
        ];
    }
}
