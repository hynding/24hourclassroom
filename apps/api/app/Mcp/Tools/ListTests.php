<?php

namespace App\Mcp\Tools;

use App\Http\Resources\TestSummaryResource;
use App\Mcp\Tools\Concerns\TeachersOnly;
use App\Models\Test;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\ResponseFactory;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Title;
use Laravel\Mcp\Server\Tool;

#[Name('list_tests')]
#[Title('List tests')]
#[Description("This teacher's own tests, newest first, 15 per page.")]
class ListTests extends Tool
{
    use TeachersOnly;

    public function handle(Request $request): Response|ResponseFactory
    {
        $teacher = $this->teacherOr($request);

        if ($teacher instanceof Response) {
            return $teacher;
        }

        $page = max(1, (int) $request->get('page', 1));

        $tests = $teacher->tests()
            ->with('author')
            ->withCount('questions')
            ->latest('id')
            ->paginate(15, ['*'], 'page', $page);

        return Response::structured([
            // resolve() runs C1's row shape and strips the MissingValue that
            // `assignment_count` is when assignments were not counted.
            'data' => $tests->getCollection()
                ->map(fn (Test $test): array => (new TestSummaryResource($test))->resolve())
                ->all(),
            'meta' => [
                'current_page' => $tests->currentPage(),
                'last_page' => $tests->lastPage(),
                'per_page' => $tests->perPage(),
                'total' => $tests->total(),
            ],
        ]);
    }

    /** @return array<string, \Illuminate\JsonSchema\Types\Type> */
    public function schema(JsonSchema $schema): array
    {
        return [
            'page' => $schema->integer()
                ->min(1)
                ->description('1-based page number; 15 rows per page.'),
        ];
    }
}
