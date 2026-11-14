<?php
// The SPA's entry point on the web host (see .htaccess): every page that is
// not a real file lands here. It serves index.html with the page's own
// <head> spliced in, so link previews (iMessage, Discord, Slack...) that
// never run JavaScript see the real title and description. Any failure
// serves index.html unchanged: this must never be why a page is down.
//
// page-head.config.php is written at build time (scripts/page-head-config.js)
// with the API base URL the bundle was built with.

require_once __DIR__ . '/page-head.lib.php';

$html = @file_get_contents(__DIR__ . '/index.html');
if ($html === false) {
    http_response_code(500);
    exit;
}

$config = is_file(__DIR__ . '/page-head.config.php') ? include __DIR__ . '/page-head.config.php' : null;
$api = is_array($config) && isset($config['api']) ? (string) $config['api'] : '';
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

header('Content-Type: text/html; charset=UTF-8');
header('Cache-Control: no-cache');
echo page_head_render($html, is_string($path) ? $path : '/', $api, 'page_head_fetch', page_head_origin($_SERVER));
