<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Attempt;
use App\Services\AttemptGrader;
use App\Support\AttemptPayload;
use App\Support\GradingAccess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AnswerGradeController extends Controller
{
    public function __invoke(Request $request, Attempt $attempt, Answer $answer): JsonResponse
    {
        $grader = $request->user();

        // The assigning teacher, or an assistant connected to them
        // (GradingAccess) -- everyone else, the student included, gets 404,
        // so a grading URL classifies nothing.
        abort_unless(GradingAccess::canGrade($grader, $attempt), 404);
        abort_unless($answer->attempt_id === $attempt->id, 404);
        abort_unless($attempt->isSubmitted(), 409, 'This attempt has not been submitted.');

        $question = $answer->question;
        // Allowlist on the enum (see QuestionType::allowsManualGrade): a
        // fill_blank override replaces its automatic score; short and long
        // answers have no other way to be scored.
        if (! $question->type->allowsManualGrade()) {
            throw ValidationException::withMessages(['awarded' => ['This question type is graded automatically.']]);
        }

        $max = (float) ($answer->graded_answer['points'] ?? $question->points);
        $data = $request->validate(['awarded' => ['required', 'numeric', 'min:0', "max:{$max}"]]);

        $answer->forceFill(['awarded' => round((float) $data['awarded'], 2), 'graded_by' => $grader->id])->save();
        (new AttemptGrader)->recompute($attempt);

        return response()->json(AttemptPayload::for($attempt->fresh()));
    }
}
