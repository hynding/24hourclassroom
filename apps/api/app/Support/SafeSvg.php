<?php

namespace App\Support;

/**
 * A conservative check for seeded SVG figures. They are written for the
 * course and shown only through <img> (no script runs there), but a file
 * opened directly is a document, so the serving route also sends a
 * sandboxing CSP. This rejects anything active or external outright.
 */
final class SafeSvg
{
    /** Null when the SVG is acceptable, else why not. */
    public static function problem(string $svg): ?string
    {
        if (! preg_match('/^\s*(<\?xml[^>]*>\s*)?<svg[\s>]/i', $svg)) {
            return 'does not start with an <svg> element';
        }
        if (! str_contains($svg, 'viewBox')) {
            return 'has no viewBox (it would not scale)';
        }
        $rules = [
            '/<script/i' => 'contains a <script>',
            '/<foreignObject/i' => 'contains a <foreignObject>',
            '/<!DOCTYPE|<!ENTITY/i' => 'contains a DOCTYPE or entity',
            '/\son[a-z]+\s*=/i' => 'has an event-handler attribute',
            '/(xlink:)?href\s*=\s*["\'](?!#)/i' => 'links to something outside itself',
            '/url\(\s*["\']?(?!#)/i' => 'loads a url() from outside itself',
            '/@import/i' => 'imports a stylesheet',
            '/javascript:/i' => 'contains javascript:',
            '/<(image|use|iframe|embed|object|audio|video|animate|set)\b/i' => 'uses an element figures may not use',
        ];
        foreach ($rules as $pattern => $why) {
            if (preg_match($pattern, $svg)) {
                return $why;
            }
        }
        if (strlen($svg) > 200 * 1024) {
            return 'is over 200 KB';
        }

        return null;
    }
}
