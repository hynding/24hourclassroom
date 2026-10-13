<?php

namespace App\Http\Controllers\Api;

use App\Enums\GradeLevel;
use App\Enums\Subject;
use App\Enums\Visibility;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseSummaryResource;
use App\Models\Course;
use App\Support\LibrarySort;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\Rule;

class CourseLibraryController extends Controller
{
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $filters = $request->validate([
            'subject' => ['nullable', Rule::enum(Subject::class)],
            'grade' => ['nullable', Rule::enum(GradeLevel::class)],
            'q' => ['nullable', 'string', 'max:100'],
            'sort' => LibrarySort::rule(),
        ]);

        // CourseAccess::showsItem for a visitor, in SQL: a test that is the
        // author's own and public; a material that is public with an active
        // author (the course's, or the original's in a branch). Change the
        // two together.
        $test = fn (Builder $q) => $q
            ->whereColumn('tests.user_id', 'courses.user_id')
            ->where('tests.visibility', Visibility::Public);
        $material = fn (Builder $q) => $q
            ->where('materials.visibility', Visibility::Public)
            ->whereHas('author', fn ($a) => $a->whereNull('deactivated_at'));

        $courses = Course::query()
            ->where('visibility', Visibility::Public)
            ->whereHas('author', fn ($q) => $q->whereNull('deactivated_at'))
            ->with('author')
            ->withCount([
                'items as tests_count' => fn (Builder $q) => $q->whereHas('test', $test),
                'items as materials_count' => fn (Builder $q) => $q->whereHas('material', $material),
            ])
            ->when($filters['subject'] ?? null, fn ($q, $s) => $q->where('subject', $s))
            ->when($filters['grade'] ?? null, fn ($q, $g) => $q->where('grade_level', $g))
            ->when($filters['q'] ?? null, function ($q, $term) {
                $escaped = addcslashes($term, '\\%_');

                return $q->where(fn ($g) => $g
                    ->where('title', 'like', "%{$escaped}%")
                    ->orWhere('description', 'like', "%{$escaped}%"));
            })
            ->tap(fn ($q) => LibrarySort::apply($q, $filters['sort'] ?? null))
            ->paginate(15)
            ->withQueryString();

        return CourseSummaryResource::collection($courses);
    }
}
