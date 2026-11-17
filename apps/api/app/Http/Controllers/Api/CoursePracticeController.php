<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Test;
use App\Services\AttemptGrader;
use App\Support\CourseAccess;
use App\Support\Metrics;
use App\Support\ResponseRules;
use App\Support\Slugs;
use App\Support\StudyProgress;
use App\Support\TestPayload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Practice mode for a course's tests: open to anyone who can see the course,
 * signed in or not. It records nothing about a guest; a signed-in learner's
 * finished run is kept as their own progress (StudyProgress), seen by no
 * one else. The answers ship with the
 * questions so a visitor can reveal any one of them without a round trip;
 * "check" grades a finished run with the same scorer real attempts use, so
 * the two can never disagree about what is right.
 */
class CoursePracticeController extends Controller
{
    public function show(Request $request, Course $course, Test $test): JsonResponse
    {
        CourseAccess::assertPractice($request->user(), $course, $test);
        $course->loadMissing('author');

        return response()->json(TestPayload::for($test, withAnswers: true) + [
            'course' => [
                'id' => $course->id,
                'title' => $course->title,
                'path' => Slugs::coursePath($course),
                'author' => ['id' => $course->author->id, 'name' => $course->author->name],
            ],
            'progress' => StudyProgress::forTest($request->user(), $test),
        ]);
    }

    /**
     * Grades a run. For a guest it writes nothing, so a repeated check costs
     * nothing but the request; a signed-in learner's run updates their own
     * best and latest score (`progress`, null when nothing is kept). Responses to unknown question
     * ids are ignored; an unanswered question scores as a blank. Items no
     * scorer can mark (short and long answers, hand-graded blanks) come
     * back with `awarded: null` for the visitor to compare against the
     * model answer themselves.
     */
    public function check(Request $request, Course $course, Test $test): JsonResponse
    {
        CourseAccess::assertPractice($request->user(), $course, $test);
        $responses = $request->validate(ResponseRules::rules())['responses'];

        $score = 0.0;
        $max = 0;
        $ungraded = 0;
        $marked = 0;
        $results = [];
        foreach ($test->questions()->get() as $question) {
            $awarded = AttemptGrader::score($question, $responses[$question->id] ?? null);
            $max += $question->points;
            if ($awarded === null) {
                $ungraded++;
            } else {
                $score += $awarded;
                $marked += $question->points;
            }
            $results[] = ['question_id' => $question->id, 'awarded' => $awarded, 'points' => $question->points];
        }

        // A finished practice run, counted per course (no person recorded).
        Metrics::bump(Metrics::PRACTICE_CHECK, $course->id);
        // The learner's own record of it, when one is kept for them.
        $row = StudyProgress::recordPractice($request->user(), $test, round($score, 2), $marked);

        return response()->json([
            'score' => round($score, 2),
            'max_score' => $max,
            'ungraded_count' => $ungraded,
            'results' => $results,
            'progress' => $row ? StudyProgress::testPayload($row) : null,
        ]);
    }
}
