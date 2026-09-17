<?php

namespace App\Support;

use App\Models\Attempt;
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
            'ungraded_count' => $attempt->isSubmitted() ? AttemptGrader::ungradedCount($attempt) : 0,
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

        return [
            'latest' => self::summary($submitted->sortByDesc('submitted_at')->first()),
            'best' => self::summary($submitted->sortByDesc(fn (Attempt $a) => (float) $a->score)->first()),
        ];
    }
}
