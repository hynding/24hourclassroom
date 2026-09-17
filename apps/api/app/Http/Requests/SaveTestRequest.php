<?php

namespace App\Http\Requests;

use App\Enums\GradeLevel;
use App\Enums\Subject;
use App\Support\QuestionRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class SaveTestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Role and ownership are checked in the controller, so the status codes stay 403/404 as specified.
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:160'],
            'description' => ['nullable', 'string', 'max:5000'],
            'subject' => ['required', Rule::enum(Subject::class)],
            'grade_level' => ['required', Rule::enum(GradeLevel::class)],
            ...QuestionRules::rules(),
        ];
    }

    protected function prepareForValidation(): void
    {
        // Ownership before validation: a non-author must get 404, never a
        // 422 that confirms the route exists for them.
        if ($this->route('test')) {
            \App\Support\TestAccess::assertAuthor($this->user(), $this->route('test'));
        }
    }

    /** @return array<int, callable> */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                foreach ((array) $this->input('questions', []) as $i => $q) {
                    if (! is_array($q)) {
                        continue;
                    }
                    if ($error = QuestionRules::shapeError($q)) {
                        $validator->errors()->add("questions.{$i}", $error);
                    }
                }
            },
        ];
    }
}
