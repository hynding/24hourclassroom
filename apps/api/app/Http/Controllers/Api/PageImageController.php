<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Support\FrontendRedirect;
use App\Support\PageHead;
use App\Support\ShareCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

/**
 * GET /api/page-image?path=/courses/12 -- the share card a link preview
 * shows for a page (og:image in PageHead::html). Always the guest view:
 * a page a guest cannot open, or a path PageHead does not describe, gets the
 * site's own card, so an image never names a private course.
 *
 * One cache entry per page (the site's card is one entry for every hidden
 * or unknown path), holding the hash of what it draws, so an edit redraws
 * the card in place rather than leaving the old one behind. Without GD's
 * FreeType the route redirects to the static card the SPA host serves.
 */
class PageImageController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $path = $request->query('path');
        $path = is_string($path) && $path !== '' && $path[0] === '/' && strlen($path) <= 200 ? (rtrim($path, '/') ?: '/') : '/';

        if (! ShareCard::supported()) {
            return redirect()->away(FrontendRedirect::spaOrigin().'/assets/share-card.png');
        }

        $pageHead = new PageHead;
        $meta = $pageHead->resolve($path) ?? $pageHead->resolve('/');
        $card = $pageHead->card($meta);

        $hash = PageHead::cardHash($card);
        $key = 'page-image:'.sha1($card['is_site'] ? '' : $meta['path']);
        $cached = Cache::get($key);
        if (is_array($cached) && ($cached['hash'] ?? null) === $hash && is_string($cached['png'] ?? null)) {
            $png = $cached['png'];
        } else {
            $png = base64_encode(ShareCard::png($card['kicker'], $card['title'], $card['detail'], $card['site'], $card['host']));
            Cache::put($key, ['hash' => $hash, 'png' => $png], now()->addWeek());
        }

        return response(base64_decode($png), 200, [
            'Content-Type' => 'image/png',
            'Cache-Control' => 'public, max-age=600',
        ]);
    }
}
