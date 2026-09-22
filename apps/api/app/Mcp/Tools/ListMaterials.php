<?php

namespace App\Mcp\Tools;

use App\Mcp\Tools\Concerns\TeachersOnly;
use App\Models\Connection;
use App\Models\Material;
use App\Support\MaterialPayload;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\ResponseFactory;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Title;
use Laravel\Mcp\Server\Tool;

#[Name('list_materials')]
#[Title('List materials')]
#[Description("List this teacher's own materials and the materials other teachers have shared with them, newest first, 15 per page.")]
class ListMaterials extends Tool
{
    use TeachersOnly;

    public function handle(Request $request): Response|ResponseFactory
    {
        $teacher = $this->teacherOr($request);

        if ($teacher instanceof Response) {
            return $teacher;
        }

        $scope = (string) $request->get('scope', 'all');
        $page = max(1, (int) $request->get('page', 1));

        // C2's shared-with-me query: a share counts only while the
        // connection to the author is ACCEPTED, and the filter is in SQL so
        // meta.total cannot lie.
        $sharedIds = Material::query()
            ->join('material_shares', 'material_shares.material_id', '=', 'materials.id')
            ->where('material_shares.user_id', $teacher->id)
            ->whereIn('materials.user_id', Connection::acceptedCounterpartIds($teacher))
            ->pluck('materials.id')
            ->all();

        $query = match ($scope) {
            'mine' => Material::query()->where('user_id', $teacher->id),
            'shared' => Material::query()->whereIn('id', $sharedIds),
            // Anything else, including the documented default: own + shared.
            default => Material::query()->where(fn ($q) => $q
                ->where('user_id', $teacher->id)
                ->orWhereIn('id', $sharedIds)),
        };

        $materials = $query->with('author')->latest('id')->paginate(15, ['*'], 'page', $page);

        return Response::structured([
            'data' => $materials->getCollection()->map(function (Material $material) use ($teacher): array {
                $row = MaterialPayload::summary($material);

                if ($material->user_id !== $teacher->id) {
                    $row['shared_by'] = ['id' => $material->author->id, 'name' => $material->author->name];
                }

                return $row;
            })->all(),
            'meta' => [
                'current_page' => $materials->currentPage(),
                'last_page' => $materials->lastPage(),
                'per_page' => $materials->perPage(),
                'total' => $materials->total(),
            ],
        ]);
    }

    /** @return array<string, \Illuminate\JsonSchema\Types\Type> */
    public function schema(JsonSchema $schema): array
    {
        return [
            'scope' => $schema->string()
                ->enum(['mine', 'shared', 'all'])
                ->description('mine = materials this teacher uploaded; shared = materials other teachers shared with them; all (the default) = both.'),
            'page' => $schema->integer()
                ->min(1)
                ->description('1-based page number; 15 rows per page.'),
        ];
    }
}
