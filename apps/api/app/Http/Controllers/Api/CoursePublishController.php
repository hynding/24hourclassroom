<?php

namespace App\Http\Controllers\Api;

use App\Enums\Visibility;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Support\CourseAccess;
use App\Support\CoursePayload;
use App\Support\CourseWriter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CoursePublishController extends Controller
{
    /**
     * Publishes the course AND everything in it (CourseWriter). On a course
     * that is already public it still sweeps the contents, which is how the
     * author publishes items that were unpublished since.
     */
    public function publish(Request $request, Course $course): JsonResponse
    {
        CourseAccess::assertAuthor($request->user(), $course);

        if (! $course->items()->exists()) {
            throw ValidationException::withMessages(['items' => ['Add at least one test or material before publishing.']]);
        }

        DB::transaction(function () use ($course) {
            if (! $course->isPublic()) {
                $course->update(['visibility' => Visibility::Public, 'published_at' => now()]);
            }
            CourseWriter::publishContents($course);
        });

        return response()->json(CoursePayload::view($course->fresh(), $request->user()));
    }

    /**
     * The course only. Its tests and materials keep their own visibility:
     * some were public before they joined, and each has its own Unpublish.
     */
    public function unpublish(Request $request, Course $course): JsonResponse
    {
        CourseAccess::assertAuthor($request->user(), $course);
        $course->update(['visibility' => Visibility::Private]);

        return response()->json(CoursePayload::view($course->fresh(), $request->user()));
    }
}
