<?php

namespace App\Http\Controllers\Api;

use App\Enums\ConnectionStatus;
use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Connection;
use App\Models\Test;
use App\Models\User;
use App\Notifications\TestAssigned;
use App\Support\AttemptPayload;
use App\Support\TestAccess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AssignmentController extends Controller
{
    public function index(Request $request, Test $test): JsonResponse
    {
        $teacher = $request->user();
        TestAccess::assertAuthor($teacher, $test);

        // Resolved once rather than per-row (Connection::acceptedBetween per
        // assignment made this endpoint N+1): every counterpart the teacher
        // currently has an accepted connection with, in either direction.
        $acceptedIds = Connection::where('status', ConnectionStatus::Accepted)
            ->where(fn ($q) => $q->where('requester_id', $teacher->id)->orWhere('addressee_id', $teacher->id))
            ->get()
            ->map(fn (Connection $c) => $c->requester_id === $teacher->id ? $c->addressee_id : $c->requester_id)
            ->all();

        $rows = $test->assignments()->with(['student', 'attempts.answers'])->get()
            // Decision 3: the results view needs a CURRENTLY accepted connection.
            ->filter(fn (Assignment $a) => $a->student->isActive() && in_array($a->student_id, $acceptedIds, true))
            ->map(fn (Assignment $a) => [
                'id' => $a->id,
                'student' => ['id' => $a->student->id, 'name' => $a->student->name],
                'due_at' => $a->due_at,
                ...AttemptPayload::latestAndBest($a->attempts),
            ])
            ->values();

        return response()->json(['data' => $rows]);
    }

    public function store(Request $request, Test $test): JsonResponse
    {
        $teacher = $request->user();
        TestAccess::assertAuthor($teacher, $test);

        $data = $request->validate([
            'student_ids' => ['required', 'array', 'min:1', 'max:100'],
            'student_ids.*' => ['integer'],
            'due_at' => ['nullable', 'date'],
        ]);

        if ($test->questions()->count() === 0) {
            throw ValidationException::withMessages(['student_ids' => ['Add at least one question before assigning.']]);
        }

        $results = [];
        foreach ($data['student_ids'] as $id) {
            $student = User::find($id);
            // Every failure reason collapses to not_found so the caller cannot
            // classify ids (decision 5). Allowlist on role.
            $eligible = $student !== null
                && $student->role === Role::Student
                && $student->isActive()
                && Connection::acceptedBetween($teacher, $student);

            if (! $eligible) {
                $results[] = ['id' => $id, 'status' => 'not_found'];

                continue;
            }

            $assignment = Assignment::firstOrCreate(
                ['test_id' => $test->id, 'student_id' => $student->id],
                ['teacher_id' => $teacher->id, 'due_at' => $data['due_at'] ?? null],
            );
            if ($assignment->wasRecentlyCreated) {
                $student->notify(new TestAssigned($assignment));
            } elseif (array_key_exists('due_at', $data)) {
                // Re-assigning an already-assigned student updates the due
                // date (a request that omits the key leaves it alone) but
                // never re-notifies -- status stays 'assigned' either way.
                $assignment->update(['due_at' => $data['due_at']]);
            }
            $results[] = ['id' => $id, 'status' => 'assigned'];
        }

        return response()->json(['results' => $results]);
    }

    public function destroy(Request $request, Test $test, Assignment $assignment): Response
    {
        TestAccess::assertAuthor($request->user(), $test);
        abort_unless($assignment->test_id === $test->id, 404);
        $assignment->delete();

        return response()->noContent();
    }
}
