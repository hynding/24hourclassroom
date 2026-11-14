<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\Connection;
use App\Support\AttemptPayload;
use App\Support\GradingAccess;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * GET /api/grading: every submitted attempt with an answer still to grade,
 * across the assignments the caller may grade (GradingAccess): their own if
 * they author, and every connected teacher's if they are a teacher assistant.
 * Oldest submission first. Anyone with nothing to grade gets an empty page,
 * not an error.
 */
class GradingQueueController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $grader = $request->user();

        // teacher id => the students they hold an accepted connection with.
        $pairs = [];
        foreach (GradingAccess::teachersFor($grader) as $teacher) {
            $students = Connection::acceptedCounterpartIds($teacher);
            if ($students !== []) {
                $pairs[$teacher->id] = $students;
            }
        }

        $query = Attempt::query()
            ->whereNotNull('submitted_at')
            ->whereHas('answers', fn (Builder $q) => $q->whereNull('awarded'))
            ->whereHas('student', fn (Builder $q) => $q->whereNull('deactivated_at'));

        if ($pairs === []) {
            $query->whereRaw('1 = 0');
        } else {
            $query->whereHas('assignment', function (Builder $q) use ($pairs) {
                $q->where(function (Builder $q) use ($pairs) {
                    foreach ($pairs as $teacherId => $students) {
                        $q->orWhere(fn (Builder $q) => $q->where('teacher_id', $teacherId)->whereIn('student_id', $students));
                    }
                });
            });
        }

        $page = $query
            ->with(['answers', 'student', 'test', 'assignment.teacher'])
            ->orderBy('submitted_at')
            ->orderBy('id')
            ->paginate(20)
            ->withQueryString();

        return response()->json([
            'data' => collect($page->items())->map(fn (Attempt $a) => AttemptPayload::summary($a) + [
                'student' => ['id' => $a->student->id, 'name' => $a->student->name],
                'test' => ['id' => $a->test->id, 'title' => $a->test->title],
                'teacher' => ['id' => $a->assignment->teacher->id, 'name' => $a->assignment->teacher->name],
            ])->values(),
            'meta' => [
                'current_page' => $page->currentPage(),
                'last_page' => $page->lastPage(),
                'per_page' => $page->perPage(),
                'total' => $page->total(),
            ],
        ]);
    }
}
