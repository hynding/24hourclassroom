<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MaterialShareResource;
use App\Models\Connection;
use App\Models\Material;
use App\Models\MaterialShare;
use App\Services\MaterialSharer;
use App\Support\MaterialAccess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class MaterialShareController extends Controller
{
    /**
     * Unpaginated, like AssignmentController::index. The connection filter is
     * resolved in ONE query and applied in memory rather than per row, which
     * is what made that endpoint N+1 the first time.
     */
    public function index(Request $request, Material $material): AnonymousResourceCollection
    {
        $author = $request->user();
        MaterialAccess::assertAuthor($author, $material);

        $acceptedIds = Connection::acceptedCounterpartIds($author);

        $rows = $material->shares()->with('user')->orderBy('id')->get()
            // Decision 4: a share is live only while the connection is.
            ->filter(fn (MaterialShare $share) => $share->user->isActive()
                && in_array($share->user_id, $acceptedIds, true))
            ->values();

        return MaterialShareResource::collection($rows);
    }

    public function store(Request $request, Material $material): JsonResponse
    {
        $author = $request->user();
        MaterialAccess::assertAuthor($author, $material);

        $data = $request->validate([
            'user_ids' => ['required', 'array', 'min:1', 'max:100'],
            'user_ids.*' => ['integer'],
        ]);

        return response()->json(['results' => MaterialSharer::share($material, $author, $data['user_ids'])]);
    }

    public function destroy(Request $request, Material $material, int $share): Response
    {
        MaterialAccess::assertAuthor($request->user(), $material);
        $material->shares()->findOrFail($share)->delete();

        return response()->noContent();
    }
}
