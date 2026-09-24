<?php

namespace App\Models;

use App\Enums\GenerationStatus;
use App\Enums\GradeLevel;
use App\Enums\Subject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Generation extends Model
{
    /** @use HasFactory<\Database\Factories\GenerationFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'subject', 'grade_level', 'instructions', 'question_count',
        'material_ids', 'file_ids', 'status', 'session_id', 'last_event_id',
        'pending_tool_event_id', 'pending_tool_result', 'tool_failures', 'agent_note',
        'error', 'list_cost_cents', 'test_id', 'started_at', 'finished_at',
        'archived_at', 'teardown_attempts',
    ];

    protected function casts(): array
    {
        return [
            'subject' => Subject::class,
            'grade_level' => GradeLevel::class,
            'status' => GenerationStatus::class,
            'material_ids' => 'array',
            'file_ids' => 'array',
            'pending_tool_result' => 'array',
            'question_count' => 'integer',
            'tool_failures' => 'integer',
            'list_cost_cents' => 'integer',
            'started_at' => 'datetime',
            'finished_at' => 'datetime',
            'archived_at' => 'datetime',
            'teardown_attempts' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    public function isTerminal(): bool
    {
        return $this->status->isTerminal();
    }

    /**
     * The one terminal transition. `error` is truncated because an Anthropic
     * message is unbounded and the column is TEXT (65,535 BYTES, not
     * characters) -- mb_strcut() cuts on a byte budget and never splits a
     * multibyte character, where Str::limit() counts display width and can
     * still overflow the column on wide UTF-8 input. The pending tool columns
     * are cleared because a result owed to an abandoned run is never sent.
     */
    public function markTerminal(GenerationStatus $status, ?string $error = null): void
    {
        $this->forceFill([
            'status' => $status,
            'error' => $error === null ? null : mb_strcut($error, 0, 60000),
            'finished_at' => now(),
            'pending_tool_event_id' => null,
            'pending_tool_result' => null,
        ])->save();
    }

    /** Non-terminal rows only -- what every sweep and teardown iterates. */
    public function scopeLive(Builder $query): void
    {
        $query->whereNotIn('status', GenerationStatus::terminal());
    }

    /** The cache-lock key every advance, cancel and teardown takes for this row. */
    public function lockKey(): string
    {
        return "generation:{$this->id}";
    }
}
