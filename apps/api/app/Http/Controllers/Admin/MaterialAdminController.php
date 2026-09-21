<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Visibility;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Notifications\MaterialModerated;
use App\Services\MaterialDeleter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MaterialAdminController extends Controller
{
    public function index(Request $request): Response
    {
        $filters = $request->validate(['q' => ['nullable', 'string', 'max:100']]);
        $term = $filters['q'] ?? null;

        $materials = Material::query()
            ->where('visibility', Visibility::Public)
            ->with('author')
            ->when($term, fn ($query, $q) => $query->where('title', 'like', '%'.addcslashes($q, '\\%_').'%'))
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString()
            ->through(fn (Material $material) => [
                'id' => $material->id,
                'title' => $material->title,
                'author' => ['id' => $material->author->id, 'name' => $material->author->name],
                'subject' => $material->subject,
                'grade_level' => $material->grade_level,
                'size_bytes' => $material->size_bytes,
                'published_at' => $material->published_at,
            ]);

        return Inertia::render('admin/materials', ['materials' => $materials, 'filters' => ['q' => $term]]);
    }

    public function unpublish(Material $material): RedirectResponse
    {
        if ($material->isPublic()) {
            $material->update(['visibility' => Visibility::Private]);
            $material->author->notify(new MaterialModerated($material));
        }

        return back();
    }

    /**
     * Delete by id works on a private material too, even though the list
     * shows only public ones: an admin removing a reported file must not need
     * it published first (mirrors TestAdminController).
     */
    public function destroy(Material $material): RedirectResponse
    {
        MaterialDeleter::delete($material);

        return back();
    }
}
