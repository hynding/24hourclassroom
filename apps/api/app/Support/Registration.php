<?php

namespace App\Support;

use App\Models\SiteSetting;

/**
 * The sign-up switch. Reads row 1 with find(1), never current(): current()'s
 * create-if-missing branch is a write, and these run on guest paths. A
 * missing row fails OPEN, matching the column default and the rule that
 * shell provisioning must work while sign-ups are closed.
 */
final class Registration
{
    public const CLOSED = 'Registration is closed.';

    public static function isOpen(): bool
    {
        return (bool) (SiteSetting::query()->find(1)?->registration_open ?? true);
    }

    public static function closedMessage(): string
    {
        return SiteSetting::query()->find(1)?->registration_message ?: self::CLOSED;
    }

    /**
     * For the JSON entry points only. An explicit JSON response, not
     * abort(403, $text): without expectsJson() Laravel would render its 403
     * view, whose @yield('message') echoes the admin's text unescaped.
     */
    public static function assertOpen(): void
    {
        if (! self::isOpen()) {
            abort(response()->json(['message' => self::closedMessage()], 403));
        }
    }
}
