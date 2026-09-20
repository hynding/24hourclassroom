<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Support\MaterialAccess;
use App\Support\MaterialPayload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MaterialShowController extends Controller
{
    public function __invoke(Request $request, Material $material): JsonResponse
    {
        $viewer = $request->user();
        MaterialAccess::assertViewer($viewer, $material);

        return response()->json(MaterialPayload::view($material, $viewer));
    }
}
