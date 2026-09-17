<?php

namespace App\Http\Controllers\Api;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\Connection;
use App\Models\Test;
use App\Notifications\AttemptSubmitted;
use App\Services\AttemptGrader;
use App\Support\AttemptPayload;
use App\Support\TestAccess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AttemptController extends Controller
{
    public function store(Request $request, Test $test): JsonResponse
    {
        $me = $request->user();
        TestAccess::assertViewer($me, $test);
        abort_unless($me->role === Role::Student, 403);

        $assignment = $test->assignments()->where('student_id', $me->id)->first();

        $open = Attempt::where('test_id', $test->id)->where('student_id', $me->id)->whereNull('submitted_at')->first();
        if ($open) {
            // A self-practice attempt started before the teacher assigned
            // this test must pick up the link once one exists, or submit
            // would never notify the teacher.
            if ($open->assignment_id === null && $assignment !== null) {
                $open->update(['assignment_id' => $assignment->id]);
            }

            return response()->json(AttemptPayload::for($open));
        }

        $attempt = Attempt::create([
            'test_id' => $test->id,
            'student_id' => $me->id,
            'assignment_id' => $assignment?->id,
            'started_at' => now(),
        ]);

        return response()->json(AttemptPayload::for($attempt), 201);
    }

    public function show(Request $request, Attempt $attempt): JsonResponse
    {
        abort_unless(AttemptPayload::canView($request->user(), $attempt), 404);

        return response()->json(AttemptPayload::for($attempt));
    }

    public function update(Request $request, Attempt $attempt): JsonResponse
    {
        abort_unless($request->user()->id === $attempt->student_id, 404);
        abort_if($attempt->isSubmitted(), 409, 'This attempt has already been submitted.');

        $data = $request->validate(['responses' => ['present', 'array']]);
        $live = $attempt->test->questions()->pluck('id')->all();

        foreach ($data['responses'] as $questionId => $response) {
            if (! in_array((int) $questionId, $live, true)) {
                continue; // Unknown or removed question ids are ignored, not errors.
            }
            $attempt->answers()->updateOrCreate(['question_id' => (int) $questionId], ['response' => $response]);
        }

        return response()->json(AttemptPayload::for($attempt->fresh()));
    }

    public function submit(Request $request, Attempt $attempt): JsonResponse
    {
        abort_unless($request->user()->id === $attempt->student_id, 404);

        // Decision 11: the guard IS the conditional update. A stale in-memory
        // read would let two concurrent submits both grade.
        $claimed = Attempt::whereKey($attempt->id)->whereNull('submitted_at')->update(['submitted_at' => now()]);
        abort_if($claimed === 0, 409, 'This attempt has already been submitted.');

        $attempt->refresh();
        (new AttemptGrader)->grade($attempt);
        $attempt->refresh();

        $assignment = $attempt->assignment;
        if ($assignment && Connection::acceptedBetween($assignment->teacher, $attempt->student)) {
            $assignment->teacher->notify(new AttemptSubmitted($attempt));
        }

        return response()->json(AttemptPayload::for($attempt));
    }
}
