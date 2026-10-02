<?php

namespace App\Support;

use App\Enums\GradeLevel;
use App\Enums\QuestionType;
use App\Enums\Subject;

/**
 * C1's test body as JSON Schema -- the input_schema of C3b's save_test_draft
 * custom tool, and the reference the MCP builder schema is asserted against.
 *
 * Hand-written beside TestRules on purpose: it omits `id` (a draft must not
 * be able to name an existing question row) and `visibility` (the writer
 * forces Private server-side). QuestionShapesTest asserts both absences and
 * the `required` list.
 */
final class TestDraftSchema
{
    /** @return array<string, mixed> */
    public static function json(): array
    {
        return [
            'type' => 'object',
            'required' => ['title', 'subject', 'grade_level', 'questions'],
            'additionalProperties' => false,
            'properties' => [
                'title' => [
                    'type' => 'string',
                    'maxLength' => 160,
                    'description' => 'The test title.',
                ],
                'description' => [
                    'type' => ['string', 'null'],
                    'maxLength' => 5000,
                    'description' => 'Optional teacher-facing description.',
                ],
                'subject' => [
                    'type' => 'string',
                    'enum' => array_column(Subject::cases(), 'value'),
                ],
                'grade_level' => [
                    'type' => 'string',
                    'enum' => array_column(GradeLevel::cases(), 'value'),
                ],
                'questions' => [
                    'type' => 'array',
                    'minItems' => 1,
                    'maxItems' => 100,
                    'items' => [
                        'type' => 'object',
                        'required' => ['type', 'prompt', 'answer'],
                        'additionalProperties' => false,
                        'properties' => [
                            'type' => [
                                'type' => 'string',
                                'enum' => array_column(QuestionType::cases(), 'value'),
                            ],
                            'prompt' => ['type' => 'string', 'maxLength' => QuestionRules::PROMPT_MAX],
                            'stimulus' => [
                                'type' => ['string', 'null'],
                                'maxLength' => QuestionRules::STIMULUS_MAX,
                                'description' => 'Optional passage, figure description or data table shared by a set of consecutive questions; repeat it verbatim on each.',
                            ],
                            'options' => [
                                'type' => 'array',
                                'minItems' => 2,
                                'maxItems' => 8,
                                'items' => ['type' => 'string', 'maxLength' => QuestionRules::OPTION_MAX],
                                'description' => 'Required for multiple_choice and multi_select; omit for every other type.',
                            ],
                            'option_explanations' => [
                                'type' => ['array', 'null'],
                                'maxItems' => 8,
                                'items' => ['type' => 'string', 'maxLength' => QuestionRules::OPTION_EXPLANATION_MAX],
                                'description' => 'Optional, multiple_choice and multi_select only: one entry per option, in order, saying why it is right or wrong.',
                            ],
                            'answer' => [
                                'description' => 'Shape depends on `type`: an option index, a list of distinct indices, a boolean, a non-empty string, {value, tolerance}, or (fill_blank) a list of accepted strings.',
                            ],
                            'points' => ['type' => 'integer', 'minimum' => 1, 'maximum' => 100],
                            'partial_credit' => [
                                'type' => 'boolean',
                                'description' => 'Only valid on multi_select.',
                            ],
                            'auto_grade' => [
                                'type' => 'boolean',
                                'description' => 'fill_blank only: false hands the item to the teacher instead of matching it automatically.',
                            ],
                            'explanation' => ['type' => ['string', 'null'], 'maxLength' => QuestionRules::EXPLANATION_MAX],
                        ],
                    ],
                ],
            ],
        ];
    }
}
