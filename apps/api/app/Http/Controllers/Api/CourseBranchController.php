<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Support\CourseAccess;
use App\Support\CourseBrancher;
use App\Support\CoursePayload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseBranchController extends Controller
{
    /**
     * TestCopyController's order: 404 when the caller cannot see the course
     * at all (a private one, the author's own included), then 403 for
     * everyone who can see it but may not branch it -- a non-teacher, or
     * the author themselves.
     */
    public function __invoke(Request $request, Course $course): JsonResponse
    {
        $me = $request->user();
        CourseAccess::assertViewer($me, $course);
        abort_unless($course->isPublic(), 404);
        abort_unless(CourseAccess::canBranch($me, $course), 403);

        $branch = CourseBrancher::branch($course, $me);

        return response()->json(CoursePayload::view($branch->fresh(), $me), 201);
    }
}
