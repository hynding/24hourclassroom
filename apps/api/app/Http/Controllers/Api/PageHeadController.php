<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Support\PageHead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * GET /api/page-head?path=/courses/12 -- the <head> fragment the SPA host's
 * index.php splices into index.html, so link previews show the page's real
 * title and description (see PageHead). 404 for a path it does not
 * describe; the caller then serves index.html untouched.
 */
class PageHeadController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $path = $request->query('path');
        abort_unless(is_string($path) && $path !== '' && $path[0] === '/' && strlen($path) <= 200, 404);

        $pageHead = new PageHead;
        $meta = $pageHead->resolve(rtrim($path, '/') ?: '/');
        abort_if($meta === null, 404);

        return response()->json(['head' => $pageHead->html($meta), 'indexable' => $meta['indexable']])
            ->header('Cache-Control', 'public, max-age=300');
    }
}
