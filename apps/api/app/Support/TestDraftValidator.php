<?php

namespace App\Support;

use Illuminate\Support\Facades\Validator as ValidatorFactory;
use Illuminate\Validation\Validator;

/**
 * C1's field rules plus C1's per-type shape check, for callers that have no
 * FormRequest: the create_test_draft MCP tool and C3b's advancer. The shape
 * pass mirrors SaveTestRequest::after() exactly -- one message per question
 * index, all of them reported together.
 */
final class TestDraftValidator
{
    /**
     * @param  array<string, mixed>  $input
     * @return array<string, mixed>
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function validate(array $input): array
    {
        $validator = ValidatorFactory::make($input, TestRules::rules());

        $validator->after(function (Validator $validator) use ($input) {
            foreach ((array) ($input['questions'] ?? []) as $i => $question) {
                if (! is_array($question)) {
                    continue;
                }

                if ($error = QuestionRules::shapeError($question)) {
                    $validator->errors()->add("questions.{$i}", $error);
                }
            }
        });

        return $validator->validate();
    }
}
