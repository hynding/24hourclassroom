<?php

namespace App\Support;

use App\Models\Question;
use Illuminate\Support\Facades\URL;

final class FigurePayload
{
    /**
     * A question's picture as the SPA draws it, or null. Built only inside
     * a payload the viewer is already allowed to see, so the signed link is
     * the capability; it carries no viewer and is shared by every payload
     * built in the same time window (see config/figures.php), which lets
     * browsers cache it. Relative signing, like material downloads.
     *
     * @return array{id: int, url: string, alt: string}|null
     */
    public static function for(Question $q): ?array
    {
        if ($q->figure_id === null) {
            return null;
        }

        return ['id' => $q->figure_id, 'url' => self::url($q->figure_id), 'alt' => (string) $q->figure_alt];
    }

    public static function url(int $figureId): string
    {
        $window = max(1, (int) config('figures.link_window_hours')) * 3600;
        $expires = (intdiv(now()->getTimestamp(), $window) + 2) * $window;

        return rtrim((string) config('app.url'), '/').URL::temporarySignedRoute(
            'figures.image',
            \Illuminate\Support\Carbon::createFromTimestamp($expires),
            ['figure' => $figureId],
            absolute: false,
        );
    }
}
