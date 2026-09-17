<?php

namespace App\Http\Controllers\Api;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveTestRequest;
use App\Http\Resources\TestSummaryResource;
use App\Models\Test;
use App\Support\TestAccess;
use App\Support\TestPayload;
use App\Support\TestWriter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        // Allowlist: only a teacher has a tests shelf. Admin is not a teacher here.
        abort_unless($request->user()->role === Role::Teacher, 403);

        return TestSummaryResource::collection(
            $request->user()->tests()
                ->with('author')
                ->withCount(['questions', 'assignments'])
                ->latest('id')
                ->paginate(15)
                ->withQueryString()
        );
    }

    public function store(SaveTestRequest $request): JsonResponse
    {
        // Role gate lives in SaveTestRequest::authorize() now, not here: that
        // hook runs before the validation rules, so a non-teacher's malformed
        // body still gets 403, not the 422 a controller-side check would let
        // through. A second copy here would only invite the two drifting
        // apart -- exactly the denylist/allowlist mismatch this codebase has
        // hit before -- so this is the one place the check lives.
        $data = $request->validated();

        $test = DB::transaction(function () use ($request, $data) {
            $test = $request->user()->tests()->create(Arr::only($data, ['title', 'description', 'subject', 'grade_level']));
            TestWriter::syncQuestions($test, $data['questions']);

            return $test;
        });

        return response()->json(TestPayload::for($test->fresh(), withAnswers: true), 201);
    }

    public function update(SaveTestRequest $request, Test $test): JsonResponse
    {
        TestAccess::assertAuthor($request->user(), $test);
        $data = $request->validated();

        DB::transaction(function () use ($test, $data) {
            $test->update(Arr::only($data, ['title', 'description', 'subject', 'grade_level']));
            TestWriter::syncQuestions($test, $data['questions']);
        });

        return response()->json(TestPayload::for($test->fresh(), withAnswers: true));
    }

    public function destroy(Request $request, Test $test): Response
    {
        TestAccess::assertAuthor($request->user(), $test);
        $test->delete();

        return response()->noContent();
    }
}
