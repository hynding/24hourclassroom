<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Support\FrontendRedirect;
use App\Support\Metrics;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * POST /api/analytics/view: the SPA counts one page view (App\Support\Metrics).
 * No auth and no cookies (the SPA sends it with credentials omitted); the
 * request itself is never stored, only the counters it bumps. Always 204,
 * so a malformed or bot request learns nothing and the SPA never retries.
 */
class PageViewController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $page = is_string($request->input('path')) ? Metrics::classify($request->input('path')) : null;
        if ($page === null || Metrics::isBot($request->userAgent())) {
            return response()->noContent();
        }

        Metrics::bump(Metrics::VIEW, $page['path']);
        if ($page['course'] !== null) {
            Metrics::bump(Metrics::COURSE_VIEW, $page['course']);
        }

        if ($request->boolean('visit')) {
            Metrics::bump(Metrics::VISIT);
            $own = (string) parse_url(FrontendRedirect::spaOrigin(), PHP_URL_HOST);
            if (($host = Metrics::referrerHost($request->input('referrer'), $own)) !== null) {
                Metrics::bumpCapped(Metrics::REFERRER, $host);
            }
            $source = $request->input('source');
            if (is_string($source) && preg_match('/^[A-Za-z0-9._-]{1,40}$/', $source)) {
                Metrics::bumpCapped(Metrics::SOURCE, strtolower($source));
            }
        }

        return response()->noContent();
    }
}
