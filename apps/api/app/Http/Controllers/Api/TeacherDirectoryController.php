<?php

namespace App\Http\Controllers\Api;

use App\Enums\GradeLevel;
use App\Enums\Role;
use App\Enums\Subject;
use App\Http\Controllers\Controller;
use App\Http\Resources\TeacherSummaryResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\Rule;

class TeacherDirectoryController extends Controller
{
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $filters = $request->validate([
            'subject' => ['nullable', Rule::enum(Subject::class)],
            'grade' => ['nullable', Rule::enum(GradeLevel::class)],
            'q' => ['nullable', 'string', 'max:100'],
        ]);

        $teachers = User::query()
            ->where('role', Role::Teacher)
            ->with('profile')
            ->when(
                $filters['subject'] ?? null,
                fn ($query, $subject) => $query->whereHas(
                    'profile',
                    fn ($profile) => $profile->whereJsonContains('subjects', $subject),
                ),
            )
            ->when(
                $filters['grade'] ?? null,
                fn ($query, $grade) => $query->whereHas(
                    'profile',
                    fn ($profile) => $profile->whereJsonContains('grade_levels', $grade),
                ),
            )
            ->when(
                $filters['q'] ?? null,
                fn ($query, $term) => $query->where(
                    fn ($group) => $group
                        ->where('name', 'like', "%{$term}%")
                        ->orWhereHas('profile', fn ($profile) => $profile->where('school', 'like', "%{$term}%")),
                ),
            )
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return TeacherSummaryResource::collection($teachers);
    }
}
