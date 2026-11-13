<?php

namespace App\Enums;

/**
 * Mirrored as SLUG_STATUSES in @24hc/shared.
 *
 * Retired: replaced by a newer slug for the same thing. A retired slug
 * keeps resolving (the SPA redirects it to the current one) and is never
 * issued to anything else, so an old link can never land on a stranger.
 */
enum SlugStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
    case Retired = 'retired';

    /** Statuses that still resolve to their target. */
    public static function resolving(): array
    {
        return [self::Approved, self::Retired];
    }
}
