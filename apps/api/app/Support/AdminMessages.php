<?php

namespace App\Support;

/** Every admin-page notice sentence, so tests reference a constant and never spell one differently. */
final class AdminMessages
{
    public const ALREADY_VERIFIED = 'Already verified.';

    public const NO_KEY = 'No key to remove.';

    public const DEACTIVATE_FIRST = 'Deactivate the account first.';

    public const ALREADY_DELETING = 'That account is already being deleted.';

    /**
     * Null when the teardown touched no live run: the page re-rendering
     * with has_key false is the confirmation. A run found terminal on its
     * own is in neither count and is rightly silent.
     */
    public static function keyRemoved(int $cancelled, int $skipped): ?string
    {
        if ($cancelled === 0 && $skipped === 0) {
            return null;
        }

        $parts = [];

        if ($cancelled > 0) {
            $parts[] = $cancelled === 1 ? '1 live generation was cancelled' : "{$cancelled} live generations were cancelled";
        }

        if ($skipped > 0) {
            // "1 generation could not…" on its own; "…; 1 could not…" after a cancelled clause.
            $noun = $cancelled > 0 ? '' : ($skipped === 1 ? ' generation' : ' generations');
            $verb = $skipped === 1 ? 'is' : 'are';
            $parts[] = "{$skipped}{$noun} could not be cancelled and {$verb} still running";
        }

        return 'Key removed. '.implode('; ', $parts).'.';
    }
}
