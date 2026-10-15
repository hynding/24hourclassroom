<?php

namespace App\Http\Controllers\Api;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Connection;
use App\Models\User;
use App\Support\AttemptPayload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * A connected student's to-do list, for the people supporting them: a parent
 * or guardian, a tutor, a teacher assistant (Role::supportsStudents). The
 * same rows the student sees at GET /api/assignments, from every teacher who
 * assigned them work. Scores only -- no answers, no attempt detail, nothing
 * writable.
 */
class StudentAssignmentsController extends Controller
{
    public function __invoke(Request $request, User $user): JsonResponse
    {
        $me = $request->user();

        // Every reason collapses to one 404 (decision 5): a student is
        // reachable only through an accepted connection, so a distinguishable
        // answer would classify ids. Allowlists on both roles.
        abort_unless(
            $me->role->supportsStudents()
            && $user->role === Role::Student
            && $user->isActive()
            && Connection::acceptedBetween($me, $user),
            404,
        );

        $rows = Assignment::where('student_id', $user->id)
            ->with(['test.author', 'test' => fn ($q) => $q->withCount('questions')])
            ->with(['attempts' => fn ($q) => $q->where('student_id', $user->id)->with('answers')])
            // Same order as the student's own list.
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

        return response()->json([
            'student' => ['id' => $user->id, 'name' => $user->name],
            'data' => $rows,
        ]);
    }
}
