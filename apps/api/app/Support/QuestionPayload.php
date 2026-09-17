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
            'options' => $q->options,
            'points' => $q->points,
            'partial_credit' => $q->partial_credit,
        ];

        // Keys are ABSENT, not null, when the viewer may not see them -- a
        // null would still announce that there is something to hide.
        return $withAnswers
            ? $base + ['answer' => $q->answer, 'explanation' => $q->explanation]
            : $base;
    }
}
