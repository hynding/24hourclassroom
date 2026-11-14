<?php

namespace App\Support;

use RuntimeException;

/**
 * The 1200×630 PNG a link preview shows beside a public page's title
 * (og:image): a kicker ("Free course"), the page's title, one detail line
 * and the site's name, drawn with GD in the SPA's own type and the Noon
 * palette's colours (apps/web/src/global/tokens.css).
 *
 * The fonts are static instances of the SPA's variable Literata and Manrope
 * (SIL Open Font License, copies beside them in resources/fonts), because
 * GD's FreeType draws a variable font only at its default weight.
 */
final class ShareCard
{
    public const WIDTH = 1200;

    public const HEIGHT = 630;

    /** Bump when the drawing changes, so cached cards and bots' copies are redrawn. */
    public const VERSION = 2;

    /** imagettftext sizes are points at 96 dpi: pixels per point. */
    private const PX = 96 / 72;

    private const SURFACE = '#fdfcf8';

    private const INK = '#1c2733';

    private const INK_MUTED = '#5b6670';

    private const ACCENT = '#1f6f54';

    private const LINE = '#e2ddd0';

    private const LEFT = 96;

    private const RIGHT = 96;

    /** GD with FreeType: without it the caller falls back to the static card. */
    public static function supported(): bool
    {
        return function_exists('imagettftext') && function_exists('imagepng');
    }

    /**
     * Whether every character of $text has a glyph in all three fonts
     * (resources/fonts/coverage.php). A missing glyph draws as nothing, so
     * a caller puts no uncovered text on a card.
     */
    public static function covers(string $text): bool
    {
        static $ranges = null;
        $ranges ??= require resource_path('fonts/coverage.php');
        foreach (mb_str_split((string) preg_replace('/\s+/u', ' ', $text)) as $char) {
            $cp = mb_ord($char);
            $ok = false;
            foreach ($ranges as [$from, $to]) {
                if ($cp >= $from && $cp <= $to) {
                    $ok = true;
                    break;
                }
            }
            if (! $ok) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param  string  $kicker  short label above the title ("Free course")
     * @param  string  $title  the page's title, wrapped to three lines at most
     * @param  string|null  $detail  under the title, two lines at most
     * @param  string  $siteName  footer, left
     * @param  string  $host  footer, right (the SPA's host name)
     */
    public static function png(string $kicker, string $title, ?string $detail, string $siteName, string $host): string
    {
        if (! self::supported()) {
            throw new RuntimeException('GD with FreeType is not available');
        }

        $img = imagecreatetruecolor(self::WIDTH, self::HEIGHT);
        imagealphablending($img, true);
        $surface = self::colour($img, self::SURFACE);
        $ink = self::colour($img, self::INK);
        $muted = self::colour($img, self::INK_MUTED);
        $accent = self::colour($img, self::ACCENT);
        $line = self::colour($img, self::LINE);

        imagefilledrectangle($img, 0, 0, self::WIDTH, self::HEIGHT, $surface);
        imagefilledrectangle($img, 0, 0, 23, self::HEIGHT, $accent);

        $serif = self::font('Literata-Bold.ttf');
        $sans = self::font('Manrope-SemiBold.ttf');
        $sansMedium = self::font('Manrope-Medium.ttf');
        $maxWidth = self::WIDTH - self::LEFT - self::RIGHT;

        // Kicker.
        $y = 110;
        imagettftext($img, 26, 0, self::LEFT, $y, $accent, $sans, self::fit(mb_strtoupper($kicker), $sans, 26, $maxWidth));

        // Title: the largest size at which it fits in three lines.
        $title = trim((string) preg_replace('/\s+/u', ' ', $title));
        foreach ([54, 48, 42, 38] as $size) {
            $lines = self::wrap($title, $serif, $size, $maxWidth);
            if (count($lines) <= 3) {
                break;
            }
        }
        $lines = array_slice($lines, 0, 3);
        if (count(self::wrap($title, $serif, $size, $maxWidth)) > 3) {
            $lines[2] = self::fit($lines[2].'…', $serif, $size, $maxWidth, true);
        }
        $lineHeight = (int) round($size * self::PX * 1.18);
        $y += 30;
        foreach ($lines as $text) {
            $y += $lineHeight;
            imagettftext($img, $size, 0, self::LEFT, $y, $ink, $serif, $text);
        }

        // Detail.
        if ($detail !== null && trim($detail) !== '') {
            $detailLines = self::wrap(trim((string) preg_replace('/\s+/u', ' ', $detail)), $sansMedium, 28, $maxWidth);
            if (count($detailLines) > 2) {
                $detailLines = [$detailLines[0], self::fit($detailLines[1].'…', $sansMedium, 28, $maxWidth, true)];
            }
            $y += 22;
            $limit = self::HEIGHT - 72 - 52 - 24; // clear of the footer rule
            foreach ($detailLines as $i => $text) {
                if ($y + 46 > $limit) {
                    break;
                }
                $last = $i + 1 < count($detailLines) && $y + 92 > $limit;
                $text = $last ? self::fit($text.'…', $sansMedium, 28, $maxWidth, true) : $text;
                $y += 46;
                imagettftext($img, 28, 0, self::LEFT, $y, $muted, $sansMedium, $text);
            }
        }

        // Footer: a rule, the site name and the host.
        $footer = self::HEIGHT - 72;
        imagefilledrectangle($img, self::LEFT, $footer - 52, self::WIDTH - self::RIGHT, $footer - 50, $line);
        imagettftext($img, 28, 0, self::LEFT, $footer, $ink, $sans, self::fit($siteName, $sans, 28, (int) ($maxWidth * 0.6)));
        $hostText = self::fit($host, $sansMedium, 24, (int) ($maxWidth * 0.38));
        imagettftext($img, 24, 0, self::WIDTH - self::RIGHT - self::width($hostText, $sansMedium, 24), $footer, $muted, $sansMedium, $hostText);

        ob_start();
        imagepng($img, null, 9);
        $png = (string) ob_get_clean();
        imagedestroy($img);

        return $png;
    }

    private static function font(string $file): string
    {
        return resource_path("fonts/{$file}");
    }

    private static function colour(\GdImage $img, string $hex): int
    {
        [$r, $g, $b] = sscanf($hex, '#%02x%02x%02x');

        return imagecolorallocate($img, $r, $g, $b);
    }

    private static function width(string $text, string $font, int $size): int
    {
        $box = imagettfbbox($size, 0, $font, $text);

        return $box === false ? 0 : abs($box[2] - $box[0]);
    }

    /** @return list<string> words packed greedily into lines of at most $max pixels */
    private static function wrap(string $text, string $font, int $size, int $max): array
    {
        $lines = [];
        $current = '';
        foreach (preg_split('/ /u', $text) ?: [] as $word) {
            $try = $current === '' ? $word : "{$current} {$word}";
            if ($current !== '' && self::width($try, $font, $size) > $max) {
                $lines[] = $current;
                $current = $word;
            } else {
                $current = $try;
            }
        }
        if ($current !== '') {
            $lines[] = $current;
        }

        return array_map(fn ($l) => self::fit($l, $font, $size, $max), $lines);
    }

    /** $text, cut with an ellipsis until it is at most $max pixels wide. */
    private static function fit(string $text, string $font, int $size, int $max, bool $hasEllipsis = false): string
    {
        if (self::width($text, $font, $size) <= $max) {
            return $text;
        }
        $base = $hasEllipsis ? mb_substr($text, 0, -1) : $text;
        while ($base !== '' && self::width(rtrim($base).'…', $font, $size) > $max) {
            $base = mb_substr($base, 0, -1);
        }
        // Back off to the last word boundary rather than cut a word, unless
        // that would leave less than half the text.
        $space = mb_strrpos($base, ' ');
        if ($space !== false && $space > mb_strlen($base) / 2) {
            $base = mb_substr($base, 0, $space);
        }

        return rtrim($base, " \t.,;:·").'…';
    }
}
