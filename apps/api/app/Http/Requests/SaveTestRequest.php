<?php

namespace App\Http\Requests;

use App\Enums\Role;
use App\Support\QuestionRules;
use App\Support\TestRules;
use Illuminate\Foundation\Http\FormRequest;
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

        return $this->user()?->role?->authors() === true;
    }

    public function rules(): array
    {
        return TestRules::rules();
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
                    if (filled($q['figure_id'] ?? null) && ! in_array((int) $q['figure_id'], $this->allowedFigures(), true)) {
                        $validator->errors()->add("questions.{$i}.figure_id", 'That picture is not one of yours.');
                    }
                }
            },
        ];
    }

    /** @var list<int>|null */
    private ?array $figures = null;

    /** @return list<int> */
    private function allowedFigures(): array
    {
        $test = $this->route('test');

        return $this->figures ??= $test instanceof \App\Models\Test
            ? \App\Support\TestWriter::allowedFigures($test)
            : \App\Models\Figure::where('user_id', $this->user()->id)->pluck('id')->map(fn ($id) => (int) $id)->all();
    }
}
