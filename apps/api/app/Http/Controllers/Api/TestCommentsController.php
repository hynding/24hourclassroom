<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Support\TestAccess;
use App\Support\TestPayload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * PUT /api/tests/{test}/comments {enabled}: the author turns the test's
 * discussion (its own thread and every question's) on or off. What closing
 * means is CommentAccess::isClosed / canRead.
 */
class TestCommentsController extends Controller
{
    public function __invoke(Request $request, Test $test): JsonResponse
    {
        TestAccess::assertAuthor($request->user(), $test);
        $data = $request->validate(['enabled' => ['required', 'boolean']]);

        $test->update(['comments_enabled' => $data['enabled']]);

        return response()->json(TestPayload::for($test->fresh(), withAnswers: true));
    }
}
