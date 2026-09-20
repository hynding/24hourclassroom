<?php

namespace App\Http\Controllers\Api;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveMaterialRequest;
use App\Http\Resources\MaterialSummaryResource;
use App\Models\Material;
use App\Models\User;
use App\Services\MaterialDeleter;
use App\Support\MaterialAccess;
use App\Support\MaterialPayload;
use App\Support\MaterialQuota;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Throwable;

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
     */
    public function store(SaveMaterialRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $request->user();
        $file = $request->file('file');

        $ext = strtolower($file->getClientOriginalExtension());
        // basename + truncate BEFORE the insert: MySQL strict mode would
        // otherwise 500 on a long name with the file already on disk.
        $originalName = Str::limit(basename($file->getClientOriginalName()), 255, '');

        $path = $file->storeAs("materials/{$user->id}", Str::random(40).'.'.$ext, config('materials.disk'));
        // The disk is throw => false, so a failed write returns false rather
        // than throwing. Without this a row with an empty path would 201.
        abort_if($path === false, 500);

        try {
            $material = DB::transaction(function () use ($user, $data, $file, $path, $originalName) {
                // The authoritative quota check. N parallel uploads at the
                // boundary all pass the request's friendly check; this one is
                // serialised behind a row lock on the author.
                User::whereKey($user->id)->lockForUpdate()->first();

                if ($error = MaterialQuota::errorFor($user, (int) $file->getSize())) {
                    throw ValidationException::withMessages(['file' => [$error]]);
                }

                return $user->materials()->create([
                    'title' => filled($data['title'] ?? null)
                        ? $data['title']
                        : Str::limit(pathinfo($originalName, PATHINFO_FILENAME), 160, ''),
                    'description' => $data['description'] ?? null,
                    'subject' => $data['subject'],
                    'grade_level' => $data['grade_level'],
                    'original_name' => $originalName,
                    'path' => $path,
                    // Content-sniffed, never the client's claim. C3 decides
                    // per file whether Claude gets a document, text or image.
                    'mime_type' => $file->getMimeType(),
                    'size_bytes' => $file->getSize(),
                ]);
            });
        } catch (Throwable $e) {
            // Anything after the store leaves an orphan file otherwise.
            Storage::disk(config('materials.disk'))->delete($path);

            throw $e;
        }

        return response()->json(MaterialPayload::view($material->fresh(), $user), 201);
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
