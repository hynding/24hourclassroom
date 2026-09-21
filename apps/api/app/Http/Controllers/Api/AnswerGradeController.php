<?php

namespace App\Http\Controllers\Api;

use App\Enums\QuestionType;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Attempt;
use App\Models\Connection;
use App\Services\AttemptGrader;
use App\Support\AttemptPayload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AnswerGradeController extends Controller
{
    public function __invoke(Request $request, Attempt $attempt, Answer $answer): JsonResponse
    {
        $teacher = $request->user();
        $assignment = $attempt->assignment;

        // Only the assigning teacher with a live connection -- everyone else
        // (the student included) gets 404, so a grading URL classifies nothing.
        abort_unless(
            $assignment !== null
            && $assignment->teacher_id === $teacher->id
            && Connection::acceptedBetween($teacher, $attempt->student),
            404,
        );
        abort_unless($answer->attempt_id === $attempt->id, 404);
        abort_unless($attempt->isSubmitted(), 409, 'This attempt has not been submitted.');

        $question = $answer->question;
        if ($question->type !== QuestionType::ShortAnswer) {
            throw ValidationException::withMessages(['awarded' => ['Only short answers are graded by hand.']]);
        }

        $max = (float) ($answer->graded_answer['points'] ?? $question->points);
        $data = $request->validate(['awarded' => ['required', 'numeric', 'min:0', "max:{$max}"]]);

        $answer->forceFill(['awarded' => round((float) $data['awarded'], 2), 'graded_by' => $teacher->id])->save();
        (new AttemptGrader)->recompute($attempt);

        return response()->json(AttemptPayload::for($attempt->fresh()));
    }
}
