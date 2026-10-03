<?php

namespace App\Support;

use App\Models\Question;

final class QuestionPayload
{
    /** @return array<string, mixed> */
    public static function for(Question $q, bool $withAnswers): array
    {
        $base = [
            'id' => $q->id,
            'position' => $q->position,
            'type' => $q->type,
            'prompt' => $q->prompt,
            'stimulus' => $q->stimulus,
            'options' => $q->options,
            'points' => $q->points,
            'partial_credit' => $q->partial_credit,
            'auto_grade' => $q->auto_grade,
        ];

        // Keys are ABSENT, not null, when the viewer may not see them -- a
        // null would still announce that there is something to hide. The
        // per-option rationales are answer-revealing (each says whether its
        // option is the right one), so they travel with the answer.
        return $withAnswers
            ? $base + ['answer' => $q->answer, 'explanation' => $q->explanation, 'option_explanations' => $q->option_explanations]
            : $base;
    }
}
