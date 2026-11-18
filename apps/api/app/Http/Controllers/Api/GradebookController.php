<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Test;
use App\Support\CourseAccess;
use App\Support\Gradebook;
use App\Support\TestAccess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/** The author's scores as a table (Gradebook); the SPA saves it as CSV. */
class GradebookController extends Controller
{
    public function test(Request $request, Test $test): JsonResponse
    {
        TestAccess::assertAuthor($request->user(), $test);

        return response()->json(Gradebook::forTest($request->user(), $test));
    }

    public function course(Request $request, Course $course): JsonResponse
    {
        CourseAccess::assertAuthor($request->user(), $course);

        return response()->json(Gradebook::forCourse($request->user(), $course));
    }
}
