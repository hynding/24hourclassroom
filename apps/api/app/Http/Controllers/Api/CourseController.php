<?php

namespace App\Http\Controllers\Api;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveCourseRequest;
use App\Http\Resources\CourseSummaryResource;
use App\Models\Course;
use App\Support\CourseAccess;
use App\Support\CoursePayload;
use App\Support\CourseWriter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /** The author's own shelf: every item counts, public or not. */
    public function index(Request $request): AnonymousResourceCollection
    {
        // Allowlist: only a teacher has a courses shelf. Admin is not a teacher here.
        abort_unless($request->user()->role === Role::Teacher, 403);

        $own = fn (string $table) => fn (Builder $q) => $q->whereColumn("{$table}.user_id", 'courses.user_id');

        return CourseSummaryResource::collection(
            $request->user()->courses()
                ->with('author')
                ->withCount([
                    'items as tests_count' => fn (Builder $q) => $q->whereHas('test', $own('tests')),
                    'items as materials_count' => fn (Builder $q) => $q->whereHas('material', $own('materials')),
                ])
                ->latest('id')
                ->paginate(15)
                ->withQueryString()
        );
    }

    public function show(Request $request, Course $course): JsonResponse
    {
        CourseAccess::assertViewer($request->user(), $course);

        return response()->json(CoursePayload::view($course, $request->user()));
    }

    /** New courses start private: publishing is a separate, deliberate step. */
    public function store(SaveCourseRequest $request): JsonResponse
    {
        $data = $request->validated();

        $course = DB::transaction(function () use ($request, $data) {
            $course = $request->user()->courses()->create(Arr::only($data, ['title', 'description', 'subject', 'grade_level']));
            CourseWriter::syncItems($course, $data['items']);

            return $course;
        });

        return response()->json(CoursePayload::view($course->fresh(), $request->user()), 201);
    }

    public function update(SaveCourseRequest $request, Course $course): JsonResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($course, $data) {
            $course->update(Arr::only($data, ['title', 'description', 'subject', 'grade_level']));
            CourseWriter::syncItems($course, $data['items']);
        });

        return response()->json(CoursePayload::view($course->fresh(), $request->user()));
    }

    /** The course only: its tests and materials stay where they are. */
    public function destroy(Request $request, Course $course): Response
    {
        CourseAccess::assertAuthor($request->user(), $course);
        $course->delete();

        return response()->noContent();
    }
}
