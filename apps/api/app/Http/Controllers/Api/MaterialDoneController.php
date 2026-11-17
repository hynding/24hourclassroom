<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Support\MaterialAccess;
use App\Support\StudyProgress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * A learner marks a material done, or not (StudyProgress). 404 for a
 * material they cannot see; 403 when no progress is kept for them (an
 * admin, or the material's own author). Returns the material's `progress`.
 */
class MaterialDoneController extends Controller
{
    public function store(Request $request, Material $material): JsonResponse
    {
        return $this->mark($request, $material, true);
    }

    public function destroy(Request $request, Material $material): JsonResponse
    {
        return $this->mark($request, $material, false);
    }

    private function mark(Request $request, Material $material, bool $done): JsonResponse
    {
        $viewer = $request->user();
        MaterialAccess::assertViewer($viewer, $material);
        abort_if(StudyProgress::forMaterial($viewer, $material) === null, 403);
        StudyProgress::markMaterial($viewer, $material, $done);

        return response()->json(StudyProgress::forMaterial($viewer, $material));
    }
}
