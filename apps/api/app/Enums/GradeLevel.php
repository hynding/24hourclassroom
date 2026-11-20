<?php

namespace App\Enums;

/**
 * Single grades for K-8, where teachers plan by grade, beside the original
 * bands (kept: existing content is filed under them, and a high-school
 * course spans grades). Order is the order of every picker: each band
 * follows its own grades.
 */
enum GradeLevel: string
{
    case Kindergarten = 'kindergarten';
    case Grade1 = 'grade-1';
    case Grade2 = 'grade-2';
    case K2 = 'k-2';
    case Grade3 = 'grade-3';
    case Grade4 = 'grade-4';
    case Grade5 = 'grade-5';
    case G3_5 = '3-5';
    case Grade6 = 'grade-6';
    case Grade7 = 'grade-7';
    case Grade8 = 'grade-8';
    case G6_8 = '6-8';
    case G9_12 = '9-12';
    case HigherEd = 'higher-ed';

    /**
     * The band a single grade belongs to, or null for a band itself.
     * Every case is named, so a new case fails here until it is placed.
     */
    public function band(): ?self
    {
        return match ($this) {
            self::Kindergarten, self::Grade1, self::Grade2 => self::K2,
            self::Grade3, self::Grade4, self::Grade5 => self::G3_5,
            self::Grade6, self::Grade7, self::Grade8 => self::G6_8,
            self::K2, self::G3_5, self::G6_8, self::G9_12, self::HigherEd => null,
        };
    }

    /**
     * The values a library filter on this level should match: a band finds
     * its own grades too, and a single grade finds content filed under its
     * band ("Grade 3" shows 3-5 work as well as Grade 3 work).
     *
     * @return list<string>
     */
    public function matching(): array
    {
        $band = $this->band();
        if ($band !== null) {
            return [$this->value, $band->value];
        }

        $grades = array_values(array_filter(self::cases(), fn (self $c) => $c->band() === $this));

        return [$this->value, ...array_map(fn (self $c) => $c->value, $grades)];
    }
}
