<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FigureWriter;
use App\Support\FigurePayload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/** Upload a question picture (authors only); the editor attaches it by id. */
class FigureController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        abort_unless($request->user()?->role?->authors() === true, 403);
        $request->validate([
            'file' => [
                'bail', 'required', 'file',
                'extensions:'.implode(',', config('figures.upload_extensions')),
                'mimetypes:'.implode(',', config('figures.upload_mimetypes')),
                'max:'.config('figures.max_file_kb'),
            ],
        ], [
            'file.*' => 'Choose a PNG or JPEG picture under '.intdiv((int) config('figures.max_file_kb'), 1024).' MB.',
        ]);

        $figure = FigureWriter::upload($request->user(), $request->file('file'));

        return response()->json(['id' => $figure->id, 'url' => FigurePayload::url($figure->id)], 201);
    }
}
