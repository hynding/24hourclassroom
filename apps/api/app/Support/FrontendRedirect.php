<?php

namespace App\Support;

class FrontendRedirect
{
    /**
     * Return $url when its origin is on the FRONTEND_URLS allowlist, else null.
     */
    public static function validate(?string $url): ?string
    {
        if ($url === null || $url === '') {
            return null;
        }

        $origin = self::origin($url);

        if ($origin === null) {
            return null;
        }

        $allowed = array_filter(explode(',', (string) config('app.frontend_urls')));

        return in_array($origin, $allowed, true) ? $url : null;
    }

    private static function origin(string $url): ?string
    {
        $parts = parse_url($url);

        if (! isset($parts['scheme'], $parts['host']) || ! in_array($parts['scheme'], ['http', 'https'], true)) {
            return null;
        }

        $origin = $parts['scheme'].'://'.$parts['host'];

        if (isset($parts['port'])) {
            $origin .= ':'.$parts['port'];
        }

        return $origin;
    }

    /**
     * The SPA origin: first FRONTEND_URLS entry, falling back to app.url.
     *
     * Trailing-slash-free: six call sites concatenate a path onto this
     * origin, and a doubled slash would break the resulting URL.
     */
    public static function spaOrigin(): string
    {
        $allowed = array_values(array_filter(explode(',', (string) config('app.frontend_urls'))));

        return rtrim($allowed[0] ?? config('app.url'), '/');
    }
}
