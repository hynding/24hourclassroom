<?php
// Helpers for index.php, kept apart so the API's Pest suite can test them
// (tests/Feature/Api/PageHeadTest.php). Plain PHP 7.4+, no Composer:
// this runs on the static web host, not inside Laravel.

/**
 * The public pages the API describes (PageHead::resolve). Anything else
 * (login, forms, a student's own pages) is served without asking.
 */
function page_head_wanted(string $path): bool
{
    // A course or teacher segment is an id or a slug (App\Support\Slugs);
    // `new` is the one SPA route that shares the shape.
    $seg = '(?!new/?$)[a-z0-9-]{1,60}';

    return (bool) preg_match("#^/(library(/(courses|tests|materials))?|teachers(/{$seg}(/{$seg}(/tests/\\d{1,10})?)?)?|(tests|materials)/\\d{1,10}|courses/{$seg}(/tests/\\d{1,10})?)?/?$#", $path);
}

/** The fragment from GET {api}/api/page-head, or null on any failure. */
function page_head_fetch(string $url): ?string
{
    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT_MS => 1000,
            CURLOPT_TIMEOUT_MS => 2000,
            CURLOPT_HTTPHEADER => ['Accept: application/json'],
        ]);
        $body = curl_exec($ch);
        $status = (int) curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        curl_close($ch);
        if (! is_string($body) || $status !== 200) {
            return null;
        }
    } else {
        $context = stream_context_create(['http' => ['timeout' => 2, 'ignore_errors' => false, 'header' => "Accept: application/json\r\n"]]);
        $body = @file_get_contents($url, false, $context);
        if (! is_string($body)) {
            return null;
        }
    }
    $data = json_decode($body, true);

    return is_array($data) && isset($data['head']) && is_string($data['head']) ? $data['head'] : null;
}

/**
 * index.html with its static <title>, description and link-preview
 * defaults replaced by the fragment, placed just before </head>. Unchanged
 * if there is no </head>.
 */
function page_head_splice(string $html, string $fragment): string
{
    $at = stripos($html, '</head>');
    if ($at === false) {
        return $html;
    }
    $head = substr($html, 0, $at);
    $head = preg_replace('#\s*<title>.*?</title>#is', '', $head);
    $head = preg_replace('#\s*<meta\s+name="description"[^>]*>#i', '', $head);
    // index.html's link-preview defaults (og:*, twitter:*) give way to the page's own.
    $head = preg_replace('#\s*<meta\s+(?:property="og:|name="twitter:)[^>]*>#i', '', $head);

    return $head . '  ' . $fragment . "\n  " . substr($html, $at);
}

/**
 * index.html's default og:image is a root-relative path; preview bots need
 * an absolute URL, so it is prefixed with this host's origin.
 */
function page_head_absolute_image(string $html, string $origin): string
{
    if ($origin === '') {
        return $html;
    }

    return str_replace('<meta property="og:image" content="/', '<meta property="og:image" content="' . htmlspecialchars(rtrim($origin, '/'), ENT_QUOTES) . '/', $html);
}

/** The request's own origin (scheme and host), or '' when the host looks wrong. */
function page_head_origin(array $server): string
{
    $host = (string) ($server['HTTP_HOST'] ?? '');
    if (! preg_match('/^[a-z0-9.-]+(:\d{1,5})?$/i', $host)) {
        return '';
    }
    $https = ($server['HTTPS'] ?? '') !== '' && strtolower((string) $server['HTTPS']) !== 'off'
        || strtolower((string) ($server['HTTP_X_FORWARDED_PROTO'] ?? '')) === 'https';

    return ($https ? 'https' : 'http') . '://' . strtolower($host);
}

/** @param callable(string): ?string $fetch */
function page_head_render(string $html, string $path, string $api, callable $fetch, string $origin = ''): string
{
    if ($api === '' || ! page_head_wanted($path)) {
        return page_head_absolute_image($html, $origin);
    }
    $fragment = $fetch(rtrim($api, '/') . '/api/page-head?path=' . rawurlencode($path));

    return $fragment === null ? page_head_absolute_image($html, $origin) : page_head_splice($html, $fragment);
}
