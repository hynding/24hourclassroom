<?php

namespace App\Http\Controllers\Api;

use App\Enums\Visibility;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Support\MaterialAccess;
use App\Support\MaterialPayload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MaterialPublishController extends Controller
{
    /**
     * No content precondition, unlike TestPublishController: a material
     * always has its file. Re-publishing after an unpublish re-stamps
     * published_at, which moves it back to the top of the library.
     */
    public function publish(Request $request, Material $material): JsonResponse
    {
        MaterialAccess::assertAuthor($request->user(), $material);

        if (! $material->isPublic()) {
            $material->update(['visibility' => Visibility::Public, 'published_at' => now()]);
        }

        return response()->json(MaterialPayload::view($material->fresh(), $request->user()));
    }

    /** Shares are untouched: they are a separate grant (decision 4). */
    public function unpublish(Request $request, Material $material): JsonResponse
    {
        MaterialAccess::assertAuthor($request->user(), $material);
        $material->update(['visibility' => Visibility::Private]);

        return response()->json(MaterialPayload::view($material->fresh(), $request->user()));
    }
}
