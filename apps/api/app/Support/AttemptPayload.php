<?php

namespace App\Support;

use App\Models\Attempt;
use App\Models\Connection;
use App\Models\User;
use App\Services\AttemptGrader;
use Illuminate\Support\Collection;

final class AttemptPayload
{
    /** @return array<string, mixed>|null */
    public static function summary(?Attempt $attempt): ?array
    {
        if ($attempt === null) {
            return null;
        }

        return [
            'id' => $attempt->id,
            'test_id' => $attempt->test_id,
            'assignment_id' => $attempt->assignment_id,
            'started_at' => $attempt->started_at,
            'submitted_at' => $attempt->submitted_at,
            'score' => $attempt->score,
            'max_score' => $attempt->max_score,
            'graded_at' => $attempt->graded_at,
            // Reuse an eager-loaded `answers` relation when the caller already
            // brought one (list endpoints do, to avoid a query per attempt);
            // only fall back to AttemptGrader's own query when it isn't there.
            'ungraded_count' => ! $attempt->isSubmitted() ? 0
                : ($attempt->relationLoaded('answers')
                    ? $attempt->answers->whereNull('awarded')->count()
                    : AttemptGrader::ungradedCount($attempt)),
        ];
    }

    /**
     * Latest = most recently SUBMITTED attempt; best = highest score among
     * submitted attempts. Open (unsubmitted) attempts count for neither.
     *
     * @param  Collection<int, Attempt>  $attempts
     * @return array{latest: array<string, mixed>|null, best: array<string, mixed>|null}
     */
    public static function latestAndBest(Collection $attempts): array
    {
        $submitted = $attempts->filter(fn (Attempt $a) => $a->isSubmitted());

        // `submitted_at` is a second-precision timestamp, so two attempts
        // submitted within the same second tie exactly. Pre-sort by id
        // descending so the stable secondary sort below resolves any tie
        // (on submitted_at, or on score for `best`) toward the more recent
        // attempt, regardless of the order the caller's collection arrived
        // in.
        $byRecency = $submitted->sortByDesc('id');

        return [
            'latest' => self::summary($byRecency->sortByDesc('submitted_at')->first()),
            'best' => self::summary($byRecency->sortByDesc(fn (Attempt $a) => (float) $a->score)->first()),
        ];
    }

    /**
     * The student who made it; or the assigning teacher while the
     * connection is accepted. Test visibility is deliberately NOT re-checked.
     */
    public static function canView(?User $viewer, Attempt $attempt): bool
    {
        if ($viewer === null) {
            return false;
        }
        if ($viewer->id === $attempt->student_id) {
            return true;
        }
        $assignment = $attempt->assignment;

        return $assignment !== null
            && $assignment->teacher_id === $viewer->id
            && Connection::acceptedBetween($viewer, $attempt->student);
    }

    /** @return array<string, mixed> */
    public static function for(Attempt $attempt): array
    {
        $attempt->loadMissing(['test', 'student', 'answers.question']);
        $rows = $attempt->answers->keyBy('question_id');

        if ($attempt->isSubmitted()) {
            // Built from the answer rows so a question removed after
            // submission (soft-deleted) still renders, with answers revealed.
            $questions = $attempt->answers
                ->sortBy(fn ($row) => $row->question->position)
                ->map(function ($row) {
                    $payload = QuestionPayload::for($row->question, withAnswers: true);

                    // `awarded`/`max_score` were computed from the frozen
                    // `graded_answer` snapshot, not the live question -- if
                    // the author edits the question afterward, the LIVE
                    // answer/points would contradict what was actually
                    // graded. Override with the snapshot when one exists;
                    // prompt/options/explanation are not part of the
                    // snapshot (decision 7) and stay live.
                    if (is_array($row->graded_answer) && array_key_exists('answer', $row->graded_answer) && array_key_exists('points', $row->graded_answer)) {
                        $payload['answer'] = $row->graded_answer['answer'];
                        $payload['points'] = $row->graded_answer['points'];
                    }

                    return $payload + [
                        'answer_id' => $row->id,
                        'response' => $row->response,
                        'awarded' => $row->awarded,
                        'graded_answer' => $row->graded_answer,
                    ];
                })
                ->values()->all();
        } else {
            $questions = $attempt->test->questions()->get()
                ->map(fn ($q) => QuestionPayload::for($q, withAnswers: false) + [
                    'response' => $rows->get($q->id)?->response,
                ])
                ->values()->all();
        }

        return self::summary($attempt) + [
            'student' => ['id' => $attempt->student->id, 'name' => $attempt->student->name],
            'test' => [
                'id' => $attempt->test->id,
                'title' => $attempt->test->title,
                'subject' => $attempt->test->subject,
                'grade_level' => $attempt->test->grade_level,
            ],
            'questions' => $questions,
        ];
    }
}
