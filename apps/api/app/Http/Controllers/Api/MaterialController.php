<?php

namespace App\Http\Controllers\Api;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveMaterialRequest;
use App\Http\Resources\MaterialSummaryResource;
use App\Models\Material;
use App\Services\MaterialDeleter;
use App\Services\MaterialWriter;
use App\Support\MaterialAccess;
use App\Support\MaterialPayload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class MaterialController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        // Allowlist: only a teacher has a materials shelf. Admin is not a
        // teacher here; the SPA gives admins an empty state.
        abort_unless($request->user()->role === Role::Teacher, 403);

        return MaterialSummaryResource::collection(
            $request->user()->materials()
                ->with('author')
                ->latest('id')
                ->paginate(15)
                ->withQueryString()
        );
    }

    /**
     * The role gate lives in SaveMaterialRequest::authorize(), which runs
     * before the rules, so a non-teacher's malformed body still gets 403.
     * The write itself -- path, sniff, quota lock, orphan cleanup -- is
     * MaterialWriter's, shared with the course seeder.
     */
    public function store(SaveMaterialRequest $request): JsonResponse
    {
        $data = $request->validated();
        $file = $request->file('file');

        $material = MaterialWriter::create(
            $request->user(),
            $file,
            $file->getClientOriginalName(),
            Arr::only($data, ['title', 'description', 'subject', 'grade_level']),
        );

        return response()->json(MaterialPayload::view($material->fresh(), $request->user()), 201);
    }

    public function update(SaveMaterialRequest $request, Material $material): JsonResponse
    {
        MaterialAccess::assertAuthor($request->user(), $material);

        // Arr::only, and `file` is not a rule on the update branch: a posted
        // file part is ignored and the stored bytes are never touched.
        $material->update(Arr::only($request->validated(), ['title', 'description', 'subject', 'grade_level']));

        return response()->json(MaterialPayload::view($material->fresh(), $request->user()));
    }

    public function destroy(Request $request, Material $material): Response
    {
        MaterialAccess::assertAuthor($request->user(), $material);
        MaterialDeleter::delete($material);

        return response()->noContent();
    }
}
