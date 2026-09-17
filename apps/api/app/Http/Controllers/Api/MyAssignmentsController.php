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
            ->with(['attempts' => fn ($q) => $q->where('student_id', $me->id)])
            ->latest('id')
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
