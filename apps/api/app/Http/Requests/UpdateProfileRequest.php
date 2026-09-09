<?php

namespace App\Http\Requests;

use App\Enums\GradeLevel;
use App\Enums\Subject;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'bio' => ['nullable', 'string', 'max:2000'],
            'school' => ['nullable', 'string', 'max:255'],
            'specialties' => ['nullable', 'string', 'max:255'],
            'subjects' => ['nullable', 'array'],
            'subjects.*' => [Rule::enum(Subject::class)],
            'grade_levels' => ['nullable', 'array'],
            'grade_levels.*' => [Rule::enum(GradeLevel::class)],
        ];
    }
}
