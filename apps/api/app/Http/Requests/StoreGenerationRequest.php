<?php

namespace App\Http\Requests;

use App\Enums\GradeLevel;
use App\Enums\Subject;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGenerationRequest extends FormRequest
{
    /**
     * The role gate is the route's `teacher` middleware, which the priority
     * list puts ahead of SubstituteBindings -- so a non-teacher is refused
     * with 403 before this request is ever constructed.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:160'],
            'subject' => ['required', Rule::enum(Subject::class)],
            'grade_level' => ['required', Rule::enum(GradeLevel::class)],
            'instructions' => ['nullable', 'string', 'max:4000'],
            // Every bound from config/generation.php, never a literal.
            'question_count' => [
                'required', 'integer',
                'min:'.config('generation.min_questions'),
                'max:'.config('generation.max_questions'),
            ],
            'material_ids' => ['required', 'array', 'min:1', 'max:'.config('generation.max_materials')],
            'material_ids.*' => ['integer', 'distinct'],
        ];
    }
}
