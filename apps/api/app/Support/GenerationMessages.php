<?php

namespace App\Support;

/**
 * Every user-facing generation sentence, in one place. The advancer, the
 * controllers, the teardowns and the SPA's assertions all read from here, so a
 * wording change is one edit and a test can never spell one differently.
 */
final class GenerationMessages
{
    public const NEVER_STARTED = 'The generation never started.';

    public const KEY_REMOVED = 'Cancelled because the Anthropic API key was removed.';

    public const NO_DRAFT = 'The agent finished without saving a draft.';

    /** The advancer appends ": {reason}". */
    public const PLATFORM_STOPPED = 'Anthropic stopped the session';

    /** The advancer appends ": {message}". */
    public const SESSION_REJECTED = 'Anthropic rejected the session';

    public const SESSION_ENDED = 'The session ended before a draft was saved.';

    public const TIMED_OUT = 'Cancelled after running for too long.';

    public const KEY_REQUIRED = 'Add your Anthropic API key on the Integrations page first.';

    public const KEY_REJECTED = 'Anthropic rejected that API key.';

    public const UNREACHABLE = 'Anthropic could not be reached. Try again in a moment.';

    /** GenerationController::store appends ": {gateway message}". */
    public const CREATE_FAILED = 'The generation could not be started';

    public const BUSY = 'The generation is busy. Try again.';

    public static function budget(): string
    {
        return sprintf(
            'Stopped at the $%s budget before a draft was saved.',
            number_format(config('generation.budget_cents') / 100, 2),
        );
    }

    public static function rejected(): string
    {
        return sprintf('The draft was rejected %d times.', config('generation.max_tool_failures'));
    }
}
