<?php

namespace App\Http\Controllers\Api;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\SharedMaterialResource;
use App\Models\Connection;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SharedMaterialController extends Controller
{
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $user = $request->user();
        // Allowlist: both roles can receive a share.
        abort_unless(in_array($user->role, [Role::Teacher, Role::Student], true), 403);

        $materials = Material::query()
            ->join('material_shares', 'material_shares.material_id', '=', 'materials.id')
            ->where('material_shares.user_id', $user->id)
            // IN SQL, before paginate(): an in-memory filter afterwards would
            // short the page and lie in meta.total.
            ->whereIn('materials.user_id', Connection::acceptedCounterpartIds($user))
            ->with('author')
            // Explicit select: the two tables' id and created_at columns would
            // otherwise clobber each other, and `id` must be the material's.
            ->select('materials.*', 'material_shares.created_at as shared_at')
            ->orderByDesc('material_shares.created_at')
            ->orderByDesc('material_shares.id')
            ->paginate(15)
            ->withQueryString();

        return SharedMaterialResource::collection($materials);
    }
}
