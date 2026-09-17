<?php

namespace App\Http\Requests;

use App\Enums\GradeLevel;
use App\Enums\Role;
use App\Enums\Subject;
use App\Support\QuestionRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class SaveTestRequest extends FormRequest
{
    /**
     * `authorize()` runs AFTER `prepareForValidation()` but BEFORE the
     * validation rules, so it is the only hook that can keep a malformed
     * body from producing a 422 before role/ownership are settled.
     *
     * On update/destroy (a `test` is route-bound), ownership was already
     * asserted as a 404 in `prepareForValidation()` below -- reaching here
     * means the caller is already confirmed to be the author, so `true`.
     *
     * On create (no bound `test`), nothing upstream has checked the role
     * yet: an allowlisted, non-teacher caller must get 403 before validation
     * ever inspects the body, or a malformed body from a non-teacher gets a
     * 422 that leaks nothing but is still the wrong status per spec.
     */
    public function authorize(): bool
    {
        if ($this->route('test')) {
            return true;
        }

        return $this->user()?->role === Role::Teacher;
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
