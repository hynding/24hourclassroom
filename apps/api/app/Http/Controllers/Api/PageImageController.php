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
 * Cards are cached by what they draw (title, detail, site name), so an edit
 * to a course draws a new card on the next fetch. Without GD's FreeType the
 * route redirects to the static card the SPA host serves.
 */
class PageImageController extends Controller
{
    /** Bump when ShareCard's drawing changes, so cached cards are redrawn. */
    private const VERSION = 1;

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

        $key = 'page-image:'.self::VERSION.':'.sha1(json_encode($card, JSON_THROW_ON_ERROR));
        $png = Cache::remember($key, now()->addWeek(), fn () => base64_encode(
            ShareCard::png($card['kicker'], $card['title'], $card['detail'], $card['site'], $card['host'])
        ));

        return response(base64_decode($png), 200, [
            'Content-Type' => 'image/png',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
