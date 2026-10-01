<?php

namespace App\Http\Controllers\Api;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Support\AttemptPayload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MyAssignmentsController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $me = $request->user();
        abort_unless($me->role === Role::Student, 403);

        $rows = Assignment::where('student_id', $me->id)
            ->with(['test.author', 'test' => fn ($q) => $q->withCount('questions')])
            ->with(['attempts' => fn ($q) => $q->where('student_id', $me->id)->with('answers')])
            // Soonest due first, undated last, then oldest first: a to-do
            // list, not a changelog. A seeded course assigns a whole year at
            // once and must read in course order.
            ->orderByRaw('due_at IS NULL')
            ->orderBy('due_at')
            ->orderBy('id')
            ->get()
            ->map(fn (Assignment $a) => [
                'id' => $a->id,
                'due_at' => $a->due_at,
                'test' => [
                    'id' => $a->test->id,
                    'title' => $a->test->title,
                    'subject' => $a->test->subject,
                    'grade_level' => $a->test->grade_level,
                    'question_count' => $a->test->questions_count,
                    'author' => ['id' => $a->test->author->id, 'name' => $a->test->author->name],
                ],
                ...AttemptPayload::latestAndBest($a->attempts),
            ])
            ->values();

        return response()->json(['data' => $rows]);
    }
}
