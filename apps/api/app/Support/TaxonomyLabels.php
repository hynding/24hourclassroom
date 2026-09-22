<?php

namespace App\Support;

/**
 * The SPA's taxonomy labels, PHP-side. Values are asserted against the
 * enums (order included) by QuestionShapesTest; the labels themselves are
 * copies of @24hc/shared's SUBJECTS / GRADE_LEVELS / QUESTION_TYPES.
 */
final class TaxonomyLabels
{
    /** @return array<int, array{value: string, label: string}> */
    public static function subjects(): array
    {
        return [
            ['value' => 'math', 'label' => 'Math'],
            ['value' => 'science', 'label' => 'Science'],
            ['value' => 'english-language-arts', 'label' => 'English/Language Arts'],
            ['value' => 'social-studies', 'label' => 'Social Studies'],
            ['value' => 'art', 'label' => 'Art'],
            ['value' => 'music', 'label' => 'Music'],
            ['value' => 'pe', 'label' => 'PE'],
            ['value' => 'world-languages', 'label' => 'World Languages'],
            ['value' => 'computer-science', 'label' => 'Computer Science'],
            ['value' => 'special-education', 'label' => 'Special Education'],
            ['value' => 'other', 'label' => 'Other'],
        ];
    }

    /** @return array<int, array{value: string, label: string}> */
    public static function gradeLevels(): array
    {
        return [
            ['value' => 'k-2', 'label' => 'K-2'],
            ['value' => '3-5', 'label' => '3-5'],
            ['value' => '6-8', 'label' => '6-8'],
            ['value' => '9-12', 'label' => '9-12'],
            ['value' => 'higher-ed', 'label' => 'Higher Ed'],
        ];
    }

    /** @return array<int, array{value: string, label: string}> */
    public static function questionTypes(): array
    {
        return [
            ['value' => 'multiple_choice', 'label' => 'Multiple choice'],
            ['value' => 'multi_select', 'label' => 'Select all that apply'],
            ['value' => 'true_false', 'label' => 'True / false'],
            ['value' => 'short_answer', 'label' => 'Short answer'],
            ['value' => 'numeric', 'label' => 'Numeric'],
        ];
    }
}
