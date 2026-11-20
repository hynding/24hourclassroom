<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Figure;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

/**
 * The signed picture stream. `int $figure`, bound by hand after the
 * signature check, for the same reason as MaterialFileController: a bound
 * model would 404/403 differently for a tampered probe.
 */
class FigureImageController extends Controller
{
    public function __invoke(int $figure): Response
    {
        $model = Figure::find($figure);
        abort_if($model === null, 404);
        $disk = Storage::disk(config('figures.disk'));
        abort_unless($disk->exists($model->path), 404);

        return response($disk->get($model->path), 200, [
            'Content-Type' => $model->mime_type,
            'X-Content-Type-Options' => 'nosniff',
            // Opened directly, an SVG is a document: no script, no fetches.
            'Content-Security-Policy' => "default-src 'none'; style-src 'unsafe-inline'; sandbox",
            'Cache-Control' => 'private, max-age='.((int) config('figures.link_window_hours') * 3600),
            'Cross-Origin-Resource-Policy' => 'cross-origin',
        ]);
    }
}
