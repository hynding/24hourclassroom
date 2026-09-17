<?php

namespace App\Support;

use App\Enums\QuestionType;
use App\Models\Test;

final class TestWriter
{
    /**
     * Replace the test's question list with `$questions` (already validated).
     * Rows whose `id` belongs to THIS test are updated in place so answers
     * keep their foreign key; any other id is ignored and a new row created;
     * live rows absent from the list are soft-deleted.
     *
     * @param  array<int, array<string, mixed>>  $questions
     */
    public static function syncQuestions(Test $test, array $questions): void
    {
        $keep = [];

        // FormRequest::validated() rebuilds this array one rule at a time
        // (`questions.*.id` before `questions.*.type`, ...), so an item
        // lacking an optional field earlier in the rule list -- e.g. no `id`
        // -- gets its key inserted later than a sibling that has one, even
        // though it came first in the request body. ksort restores the
        // original 0..n-1 order before array_values renumbers positions.
        ksort($questions);

        foreach (array_values($questions) as $position => $q) {
            $type = QuestionType::from($q['type']);
            $attrs = [
                'position' => $position,
                'type' => $type,
                'prompt' => $q['prompt'],
                'options' => $type->hasOptions() ? array_values($q['options']) : null,
                'answer' => $q['answer'],
                'points' => $q['points'] ?? 1,
                'partial_credit' => $type === QuestionType::MultiSelect ? (bool) ($q['partial_credit'] ?? false) : false,
                'explanation' => $q['explanation'] ?? null,
            ];

            $existing = isset($q['id']) ? $test->questions()->whereKey($q['id'])->first() : null;
            if ($existing) {
                $existing->update($attrs);
                $keep[] = $existing->id;
            } else {
                $keep[] = $test->questions()->create($attrs)->id;
            }
        }

        $test->questions()->whereNotIn('id', $keep)->get()->each->delete();
    }
}
