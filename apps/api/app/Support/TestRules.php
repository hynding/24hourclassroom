<?php

namespace App\Support;

use App\Enums\GradeLevel;
use App\Enums\Subject;
use Illuminate\Validation\Rule;

/**
 * C1's `POST /tests` body rules, lifted verbatim out of SaveTestRequest so
 * the two non-HTTP writers (the create_test_draft MCP tool and C3b's
 * advancer) validate against the same list. The method is pure -- it
 * referenced no `$this` in the FormRequest -- so the move is mechanical.
 *
 * `questions max:100` and `description max:5000` stay as C1 set them: a
 * hand-written draft may carry 100 questions even though a generation asks
 * for at most 30.
 */
final class TestRules
{
    /** @return array<string, array<int, mixed>> */
    public static function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:160'],
            'description' => ['nullable', 'string', 'max:5000'],
            'subject' => ['required', Rule::enum(Subject::class)],
            'grade_level' => ['required', Rule::enum(GradeLevel::class)],
            ...QuestionRules::rules(),
        ];
    }
}
