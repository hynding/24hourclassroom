<?php

namespace App\Enums;

enum GenerationStatus: string
{
    /** The row exists but no session does -- only persists if the create request died. */
    case Queued = 'queued';
    case Running = 'running';
    /** A save_test_draft result is committed but not yet sent back to Anthropic. */
    case AwaitingTool = 'awaiting_tool';
    case Done = 'done';
    case Failed = 'failed';
    case Cancelled = 'cancelled';
    case BudgetReached = 'budget_reached';

    /**
     * An exhaustive match, not a denylist: an eighth case fails to compile
     * here instead of silently becoming "live" for ever (CLAUDE.md, the
     * recurring defect class).
     */
    public function isTerminal(): bool
    {
        return match ($this) {
            self::Done, self::Failed, self::Cancelled, self::BudgetReached => true,
            self::Queued, self::Running, self::AwaitingTool => false,
        };
    }

    /** The terminal values, for whereNotIn(). @return list<string> */
    public static function terminal(): array
    {
        return array_values(array_map(
            fn (self $case) => $case->value,
            array_filter(self::cases(), fn (self $case) => $case->isTerminal()),
        ));
    }
}
