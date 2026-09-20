<?php

namespace App\Http\Controllers\Api;

use App\Enums\Visibility;
use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Support\TestAccess;
use App\Support\TestPayload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TestPublishController extends Controller
{
    public function publish(Request $request, Test $test): JsonResponse
    {
        TestAccess::assertAuthor($request->user(), $test);

        if ($test->questions()->count() === 0) {
            throw ValidationException::withMessages(['questions' => ['Add at least one question before publishing.']]);
        }

        if (! $test->isPublic()) {
            $test->update(['visibility' => Visibility::Public, 'published_at' => now()]);
        }

        return response()->json(TestPayload::for($test->fresh(), withAnswers: true));
    }

    public function unpublish(Request $request, Test $test): JsonResponse
    {
        TestAccess::assertAuthor($request->user(), $test);
        $test->update(['visibility' => Visibility::Private]);

        return response()->json(TestPayload::for($test->fresh(), withAnswers: true));
    }
}
