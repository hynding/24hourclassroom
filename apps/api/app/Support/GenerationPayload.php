<?php

namespace App\Support;

use App\Models\Generation;

/**
 * The ONE generation body: the list, the create response, cancel and (plan 3)
 * the poll all return exactly this, so the SPA's spread-merge after a poll can
 * never drop a key.
 */
final class GenerationPayload
{
    /** @return array<string, mixed> */
    public static function for(Generation $generation): array
    {
        return [
            'id' => $generation->id,
            'title' => $generation->title,
            'subject' => $generation->subject,
            'grade_level' => $generation->grade_level,
            'instructions' => $generation->instructions,
            'question_count' => $generation->question_count,
            'material_ids' => $generation->material_ids ?? [],
            'status' => $generation->status,
            'agent_note' => $generation->agent_note,
            'error' => $generation->error,
            'list_cost_cents' => $generation->list_cost_cents,
            'test_id' => $generation->test_id,
            'started_at' => $generation->started_at,
            'finished_at' => $generation->finished_at,
            'created_at' => $generation->created_at,
        ];
    }
}
