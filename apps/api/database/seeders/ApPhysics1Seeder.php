<?php

namespace Database\Seeders;

use Database\Seeders\Curriculum\CurriculumSeeder;

/**
 * The AP Physics 1 course: database/seeders/data/ap-physics-1, original
 * material organised around the AP Physics 1: Algebra-Based Course and Exam
 * Description (the revised course, effective fall 2024).
 *
 *   php artisan db:seed --class=ApPhysics1Seeder             (demo accounts)
 *   php artisan course:seed-ap-physics-1 --teacher=EMAIL    (your own account)
 */
class ApPhysics1Seeder extends CurriculumSeeder
{
    /** course.yaml's `slug`: the course row's slug and every item's slug prefix. */
    public const COURSE_SLUG = 'apphys1';

    public static function defaultDir(): string
    {
        return database_path('seeders/data/ap-physics-1');
    }
}
