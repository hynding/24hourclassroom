<?php

namespace App\Http\Controllers\Api;

use App\Enums\GradeLevel;
use App\Enums\Subject;
use App\Enums\Visibility;
use App\Http\Controllers\Controller;
use App\Http\Resources\MaterialSummaryResource;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\Rule;

class MaterialsLibraryController extends Controller
{
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $filters = $request->validate([
            'subject' => ['nullable', Rule::enum(Subject::class)],
            'grade' => ['nullable', Rule::enum(GradeLevel::class)],
            'q' => ['nullable', 'string', 'max:100'],
        ]);

        $materials = Material::query()
            ->where('visibility', Visibility::Public)
            ->whereHas('author', fn ($q) => $q->whereNull('deactivated_at'))
            ->with('author')
            ->when($filters['subject'] ?? null, fn ($q, $s) => $q->where('subject', $s))
            ->when($filters['grade'] ?? null, fn ($q, $g) => $q->where('grade_level', $g))
            ->when($filters['q'] ?? null, function ($q, $term) {
                $escaped = addcslashes($term, '\\%_');

                return $q->where(fn ($g) => $g
                    ->where('title', 'like', "%{$escaped}%")
                    ->orWhere('description', 'like', "%{$escaped}%"));
            })
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        return MaterialSummaryResource::collection($materials);
    }
}
