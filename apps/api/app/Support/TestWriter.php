<?php

namespace App\Support;

use App\Enums\QuestionType;
use App\Models\Figure;
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
        $figures = self::allowedFigures($test);

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
                'stimulus' => filled($q['stimulus'] ?? null) ? $q['stimulus'] : null,
                // Only a picture the author owns or this test already shows
                // (a copy keeps its source's); anything else is dropped.
                'figure_id' => in_array((int) ($q['figure_id'] ?? 0), $figures, true) ? (int) $q['figure_id'] : null,
                'figure_alt' => in_array((int) ($q['figure_id'] ?? 0), $figures, true) ? trim((string) ($q['figure_alt'] ?? '')) : null,
                'options' => $type->hasOptions() ? array_values($q['options']) : null,
                // Same array_values rule as options: the two lists are
                // parallel, so an associative object would mis-pair them.
                'option_explanations' => ($type->hasOptions() && isset($q['option_explanations']))
                    ? array_values($q['option_explanations'])
                    : null,
                'answer' => $q['answer'],
                'points' => $q['points'] ?? 1,
                'partial_credit' => $type === QuestionType::MultiSelect ? (bool) ($q['partial_credit'] ?? false) : false,
                'auto_grade' => $type === QuestionType::FillBlank ? (bool) ($q['auto_grade'] ?? true) : true,
                'explanation' => $q['explanation'] ?? null,
            ];

            // A repeated id must not collapse two submitted rows into one: the
            // first occurrence claims the existing row; a later occurrence of
            // the SAME id is treated as a new row instead of re-fetching (and
            // overwriting) what the first occurrence already claimed, which
            // would leave $keep with a duplicate and soft-delete everything
            // else on the sweep below.
            $existing = (isset($q['id']) && ! in_array($q['id'], $keep, true))
                ? $test->questions()->whereKey($q['id'])->first()
                : null;
            if ($existing) {
                $existing->update($attrs);
                $keep[] = $existing->id;
            } else {
                $keep[] = $test->questions()->create($attrs)->id;
            }
        }

        $test->questions()->whereNotIn('id', $keep)->get()->each->delete();
    }

    /**
     * Figure ids a question of `$test` may point at: the author's own, and
     * any its questions point at already.
     *
     * @return list<int>
     */
    public static function allowedFigures(Test $test): array
    {
        $own = Figure::where('user_id', $test->user_id)->pluck('id');
        $shown = $test->questions()->whereNotNull('figure_id')->pluck('figure_id');

        return $own->merge($shown)->map(fn ($id) => (int) $id)->unique()->values()->all();
    }
}
