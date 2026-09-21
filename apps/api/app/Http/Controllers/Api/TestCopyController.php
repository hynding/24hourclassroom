<?php

namespace App\Http\Controllers\Api;

use App\Enums\Visibility;
use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Support\TestAccess;
use App\Support\TestPayload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestCopyController extends Controller
{
    public function __invoke(Request $request, Test $test): JsonResponse
    {
        // Visibility first (404), then "is it public" (404 -- a private test
        // is not copyable even by its author, and saying so would classify
        // it), then TestAccess::canCopy (403 -- existence is already public,
        // and this covers both a non-teacher and the author copying their
        // own test, since a self-copy is excluded by canCopy).
        TestAccess::assertViewer($request->user(), $test);
        abort_unless($test->isPublic(), 404);
        abort_unless(TestAccess::canCopy($request->user(), $test), 403);

        $copy = DB::transaction(function () use ($request, $test) {
            $copy = $request->user()->tests()->create([
                'title' => $test->title,
                'description' => $test->description,
                'subject' => $test->subject,
                'grade_level' => $test->grade_level,
                'visibility' => Visibility::Private,
                'copied_from_id' => $test->id,
            ]);
            foreach ($test->questions as $q) {
                $copy->questions()->create($q->only(['position', 'type', 'prompt', 'options', 'answer', 'points', 'partial_credit', 'explanation']));
            }

            return $copy;
        });

        return response()->json(TestPayload::for($copy->fresh(), withAnswers: true), 201);
    }
}
