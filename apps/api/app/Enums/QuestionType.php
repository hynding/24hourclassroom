<?php

namespace App\Enums;

enum QuestionType: string
{
    case MultipleChoice = 'multiple_choice';
    case MultiSelect = 'multi_select';
    case TrueFalse = 'true_false';
    case ShortAnswer = 'short_answer';
    case Numeric = 'numeric';
    case FillBlank = 'fill_blank';
    case LongAnswer = 'long_answer';

    /** Types whose `options` array is required (all others must omit it). */
    public function hasOptions(): bool
    {
        return match ($this) {
            self::MultipleChoice, self::MultiSelect => true,
            self::TrueFalse, self::ShortAnswer, self::Numeric, self::FillBlank, self::LongAnswer => false,
        };
    }

    /**
     * Types the grader never scores: `AttemptGrader::score` is null and the
     * item waits for a teacher. `fill_blank` is NOT here: it is auto-graded
     * unless its own `auto_grade` flag says otherwise (see the grader).
     */
    public function isManuallyGraded(): bool
    {
        return match ($this) {
            self::ShortAnswer, self::LongAnswer => true,
            self::MultipleChoice, self::MultiSelect, self::TrueFalse, self::Numeric, self::FillBlank => false,
        };
    }

    /**
     * Types a teacher may set `awarded` on by hand. Allowlist, every case
     * named: the previous `!== ShortAnswer` denylist is the Role-enum defect
     * class, where the next case added is accepted by default.
     */
    public function allowsManualGrade(): bool
    {
        return match ($this) {
            self::ShortAnswer, self::LongAnswer, self::FillBlank => true,
            self::MultipleChoice, self::MultiSelect, self::TrueFalse, self::Numeric => false,
        };
    }
}
