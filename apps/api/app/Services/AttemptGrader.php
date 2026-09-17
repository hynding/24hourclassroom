<?php

namespace App\Services;

use App\Enums\QuestionType;
use App\Models\Attempt;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

/**
 * Pure scoring per question type plus the two attempt-level passes.
 * Decision 9: a malformed response is WRONG (0), never an exception.
 */
final class AttemptGrader
{
    public static function score(Question $q, mixed $response): ?float
    {
        $points = (float) $q->points;
        $answer = $q->answer;

        return match ($q->type) {
            QuestionType::MultipleChoice => (is_int($response) && $response === $answer) ? $points : 0.0,
            QuestionType::TrueFalse => (is_bool($response) && $response === $answer) ? $points : 0.0,
            QuestionType::MultiSelect => self::scoreMultiSelect($q, $response),
            QuestionType::Numeric => self::scoreNumeric($q, $response),
            QuestionType::ShortAnswer => null,
        };
    }

    private static function scoreMultiSelect(Question $q, mixed $response): float
    {
        if (! is_array($response) || ! array_is_list($response)) {
            return 0.0;
        }
        foreach ($response as $pick) {
            if (! is_int($pick)) {
                return 0.0;
            }
        }

        $correct = (array) $q->answer;
        $picks = array_values(array_unique($response));
        $right = count(array_intersect($picks, $correct));
        $wrong = count($picks) - $right;

        if (! $q->partial_credit) {
            return ($wrong === 0 && $right === count($correct)) ? (float) $q->points : 0.0;
        }

        $fraction = max(0, $right - $wrong) / max(1, count($correct));

        return round($fraction * $q->points, 2);
    }

    private static function scoreNumeric(Question $q, mixed $response): float
    {
        $isNumber = is_int($response) || is_float($response) || (is_string($response) && is_numeric($response));
        if (! $isNumber) {
            return 0.0;
        }

        $answer = (array) $q->answer;
        $value = (float) ($answer['value'] ?? 0);
        $tolerance = (float) ($answer['tolerance'] ?? 0);

        return abs((float) $response - $value) <= $tolerance ? (float) $q->points : 0.0;
    }

    /** Submit-time pass. */
    public function grade(Attempt $attempt): void
    {
        DB::transaction(function () use ($attempt) {
            $questions = $attempt->test->questions()->get();
            $liveIds = $questions->pluck('id')->all();

            // A response to a question removed between save and submit is
            // not gradable and must not count as "ungraded".
            $attempt->answers()->whereNotIn('question_id', $liveIds)->delete();
            $rows = $attempt->answers()->get()->keyBy('question_id');

            $max = 0.0;
            foreach ($questions as $q) {
                $max += $q->points;
                $row = $rows->get($q->id) ?? $attempt->answers()->create(['question_id' => $q->id, 'response' => null]);
                $row->forceFill([
                    'awarded' => self::score($q, $row->response),
                    'graded_answer' => ['answer' => $q->answer, 'points' => $q->points],
                ])->save();
            }

            $attempt->forceFill(['max_score' => $max])->save();
            $this->recompute($attempt);
        });
    }

    /** Re-sum after any change to `awarded`. */
    public function recompute(Attempt $attempt): void
    {
        $rows = $attempt->answers()->get();
        $ungraded = $rows->whereNull('awarded')->count();

        $attempt->forceFill([
            'score' => round((float) $rows->sum(fn ($r) => (float) ($r->awarded ?? 0)), 2),
            'graded_at' => $ungraded === 0 ? now() : null,
        ])->save();
    }

    public static function ungradedCount(Attempt $attempt): int
    {
        return $attempt->answers()->whereNull('awarded')->count();
    }
}
