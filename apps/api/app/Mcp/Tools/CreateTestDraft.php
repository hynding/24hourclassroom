<?php

namespace App\Mcp\Tools;

use App\Enums\GradeLevel;
use App\Enums\QuestionType;
use App\Enums\Subject;
use App\Mcp\Tools\Concerns\TeachersOnly;
use App\Support\FrontendRedirect;
use App\Support\QuestionRules;
use App\Support\TestDraftValidator;
use App\Support\TestDraftWriter;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\ResponseFactory;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Title;
use Laravel\Mcp\Server\Tool;

#[Name('create_test_draft')]
#[Title('Create a private test draft')]
#[Description('Create a new PRIVATE test in this teacher\'s account from a complete set of questions. It never publishes and never modifies an existing test. Call list_taxonomies first: every question must match its type\'s shape exactly.')]
class CreateTestDraft extends Tool
{
    use TeachersOnly;

    public function handle(Request $request): Response|ResponseFactory
    {
        $teacher = $this->teacherOr($request);

        if ($teacher instanceof Response) {
            return $teacher;
        }

        try {
            // The builder schema below declares the loose structure; this is
            // where the per-type shape rules are enforced, by exactly the
            // code POST /api/tests uses.
            $data = TestDraftValidator::validate($request->all());
        } catch (ValidationException $e) {
            // ONE error listing every message, so a model can fix all of
            // them in a single retry instead of one per round trip.
            return Response::error(implode(' ', Arr::flatten($e->errors())));
        }

        // Private, owned by the caller, `visibility` from the body ignored.
        $test = TestDraftWriter::create($teacher, $data);

        return Response::structured([
            'id' => $test->id,
            'title' => $test->title,
            'question_count' => $test->questions()->count(),
            'url' => FrontendRedirect::spaOrigin()."/tests/{$test->id}/edit",
        ]);
    }

    /** @return array<string, \Illuminate\JsonSchema\Types\Type> */
    public function schema(JsonSchema $schema): array
    {
        return [
            'title' => $schema->string()->max(160)->required()
                ->description('The test title.'),
            'description' => $schema->string()->max(5000)
                ->description('Optional teacher-facing description.'),
            'subject' => $schema->string()->enum(Subject::class)->required()
                ->description('One subject value from list_taxonomies.'),
            'grade_level' => $schema->string()->enum(GradeLevel::class)->required()
                ->description('One grade level value from list_taxonomies.'),
            'questions' => $schema->array()->min(1)->max(100)->required()
                ->description('1 to 100 questions, in the order they should appear.')
                ->items($schema->object([
                    'type' => $schema->string()->enum(QuestionType::class)->required()
                        ->description('One question type value from list_taxonomies.'),
                    'prompt' => $schema->string()->max(QuestionRules::PROMPT_MAX)->required()
                        ->description('The question as the student reads it.'),
                    'stimulus' => $schema->string()->max(QuestionRules::STIMULUS_MAX)
                        ->description('Optional passage or data table shared by consecutive questions; repeat it verbatim on each.'),
                    'options' => $schema->array()->min(2)->max(8)
                        ->items($schema->string()->max(QuestionRules::OPTION_MAX))
                        ->description('Required for multiple_choice and multi_select; omit for every other type.'),
                    'option_explanations' => $schema->array()->max(8)
                        ->items($schema->string()->max(QuestionRules::OPTION_EXPLANATION_MAX))
                        ->description('Optional, multiple_choice and multi_select only: one entry per option saying why it is right or wrong.'),
                    // No single JSON type fits: an option index, a list of
                    // indices, a boolean, a string, {value, tolerance}, or a
                    // list of accepted strings.
                    'answer' => $schema->union(['string', 'integer', 'number', 'boolean', 'array', 'object'])->required()
                        ->description('The correct answer in the shape this type requires -- see list_taxonomies.'),
                    'points' => $schema->integer()->min(1)->max(100)
                        ->description('Defaults to 1; 4 to 10 on long_answer.'),
                    'partial_credit' => $schema->boolean()
                        ->description('Only valid on multi_select.'),
                    'auto_grade' => $schema->boolean()
                        ->description('fill_blank only: false hands the item to the teacher.'),
                    'explanation' => $schema->string()->max(QuestionRules::EXPLANATION_MAX)
                        ->description('Optional rationale shown after grading; the acceptable-answer summary on hand-graded types.'),
                ])),
        ];
    }
}
