<?php

namespace App\Mcp\Tools;

use App\Mcp\Tools\Concerns\TeachersOnly;
use App\Support\QuestionShapes;
use App\Support\TaxonomyLabels;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Illuminate\Support\Arr;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\ResponseFactory;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Title;
use Laravel\Mcp\Server\Tool;

#[Name('list_taxonomies')]
#[Title('List subjects, grades and question shapes')]
#[Description('The closed lists this app accepts: subjects, grade levels, question types, and the exact options/answer shape each question type requires. Read this before writing a draft.')]
class ListTaxonomies extends Tool
{
    use TeachersOnly;

    public function handle(Request $request): Response|ResponseFactory
    {
        $teacher = $this->teacherOr($request);

        if ($teacher instanceof Response) {
            return $teacher;
        }

        return Response::structured([
            'subjects' => TaxonomyLabels::subjects(),
            'grade_levels' => TaxonomyLabels::gradeLevels(),
            'question_types' => TaxonomyLabels::questionTypes(),
            // The valid example is useful to a model; the deliberately
            // invalid one is not -- it belongs in the system prompt, where
            // QuestionShapes::text() renders it, not in a tool result.
            'shapes' => array_map(
                fn (array $shape): array => Arr::only($shape, ['options', 'answer', 'extras', 'valid']),
                QuestionShapes::table(),
            ),
        ]);
    }

    /** @return array<string, \Illuminate\JsonSchema\Types\Type> */
    public function schema(JsonSchema $schema): array
    {
        return [];
    }
}
