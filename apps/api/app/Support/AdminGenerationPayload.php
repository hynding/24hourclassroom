<?php

namespace App\Support;

use App\Models\Generation;

/**
 * The admin pages' view of a run. Never the owner's integration: the API key
 * stays off every page, and the one fact the detail page needs about it
 * (`owner_has_key`) is a boolean the controller derives from the ciphertext
 * column without ever decrypting it.
 */
final class AdminGenerationPayload
{
    /** @return array<string, mixed> */
    public static function row(Generation $generation): array
    {
        return [
            'id' => $generation->id,
            'user' => ['id' => $generation->user->id, 'name' => $generation->user->name],
            'title' => $generation->title,
            'subject' => $generation->subject->value,
            'grade_level' => $generation->grade_level->value,
            'status' => $generation->status->value,
            // Computed here so the page never carries its own copy of the
            // terminal split (CLAUDE.md: the mirrored-enum defect class).
            'live' => ! $generation->isTerminal(),
            'list_cost_cents' => $generation->list_cost_cents,
            'started_at' => $generation->started_at?->toIso8601String(),
            'finished_at' => $generation->finished_at?->toIso8601String(),
            // Null unless BOTH are set: a create that died in `queued` and was
            // swept has finished_at and no started_at.
            'duration_seconds' => $generation->started_at !== null && $generation->finished_at !== null
                ? (int) $generation->started_at->diffInSeconds($generation->finished_at)
                : null,
            'has_leftovers' => $generation->hasLeftovers(),
            'test_id' => $generation->test_id,
        ];
    }

    /** @return array<string, mixed> */
    public static function detail(Generation $generation, bool $ownerHasKey): array
    {
        return [
            ...self::row($generation),
            'user' => ['id' => $generation->user->id, 'name' => $generation->user->name, 'email' => $generation->user->email],
            'instructions' => $generation->instructions,
            'material_ids' => $generation->material_ids,
            'file_ids' => $generation->file_ids,
            'session_id' => $generation->session_id,
            'error' => $generation->error,
            'agent_note' => $generation->agent_note,
            'tool_failures' => $generation->tool_failures,
            'teardown_attempts' => $generation->teardown_attempts,
            'archived_at' => $generation->archived_at?->toIso8601String(),
            'created_at' => $generation->created_at->toIso8601String(),
            'test' => $generation->test ? ['id' => $generation->test->id, 'title' => $generation->test->title] : null,
            'owner_has_key' => $ownerHasKey,
        ];
    }
}
