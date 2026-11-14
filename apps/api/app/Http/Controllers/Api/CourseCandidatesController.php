<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * What the course editor can add: every test and material the teacher owns,
 * compact and unpaginated. The paginated shelves would cost the editor one
 * request per page out of the caller's single 60/min budget, and materials
 * are already capped per teacher (MaterialQuota).
 */
class CourseCandidatesController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        // Allowlist, as on every other authoring endpoint.
        abort_unless($request->user()->role->authors(), 403);
        $me = $request->user();

        return response()->json([
            'tests' => $me->tests()
                ->withCount('questions')
                ->orderBy('title')->orderBy('id')
                ->get()
                ->map(fn ($t) => ['id' => $t->id, 'title' => $t->title, 'visibility' => $t->visibility, 'question_count' => $t->questions_count])
                ->all(),
            'materials' => $me->materials()
                ->orderBy('title')->orderBy('id')
                ->get()
                ->map(fn ($m) => ['id' => $m->id, 'title' => $m->title, 'visibility' => $m->visibility, 'original_name' => $m->original_name])
                ->all(),
        ]);
    }
}
