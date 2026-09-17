<?php

namespace App\Enums;

enum QuestionType: string
{
    case MultipleChoice = 'multiple_choice';
    case MultiSelect = 'multi_select';
    case TrueFalse = 'true_false';
    case ShortAnswer = 'short_answer';
    case Numeric = 'numeric';

    /** Types whose `options` array is required (all others must omit it). */
    public function hasOptions(): bool
    {
        return match ($this) {
            self::MultipleChoice, self::MultiSelect => true,
            self::TrueFalse, self::ShortAnswer, self::Numeric => false,
        };
    }
}
