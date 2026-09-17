<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AssignmentResultResource;
use App\Models\Connection;
use App\Models\Test;
use App\Support\TestAccess;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TestAttemptsController extends Controller
{
    public function __invoke(Request $request, Test $test): AnonymousResourceCollection
    {
        $teacher = $request->user();
        TestAccess::assertAuthor($teacher, $test);

        // `pair_key` cannot be expressed as a subquery on student_id, so
        // resolve the teacher's accepted counterparts first.
        $acceptedIds = Connection::acceptedCounterpartIds($teacher);

        // Paginate by ASSIGNMENT (one row per student). Self-practice attempts
        // have no assignment and never appear here (decision 4).
        $page = $test->assignments()
            ->whereIn('student_id', $acceptedIds)
            ->whereHas('student', fn ($q) => $q->whereNull('deactivated_at'))
            ->with(['student', 'attempts.answers'])
            ->orderBy('id')
            ->paginate(15)
            ->withQueryString();

        return AssignmentResultResource::collection($page);
    }
}
