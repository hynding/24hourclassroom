<?php

namespace App\Support;

use App\Models\Attempt;
use App\Models\Connection;
use App\Models\User;

/**
 * Who may read and hand-grade a student's submitted attempt on an assignment.
 *
 * - The assigning teacher, while their connection with the student is
 *   accepted (the rule that predates this class).
 * - A `Role::gradesForConnectedTeachers()` user (a teacher assistant) who
 *   holds an accepted connection with that assigning teacher, while the
 *   teacher's own connection with the student is accepted and both the
 *   teacher and the student are active. The assistant needs no connection
 *   with the student: they work through the teacher's roster.
 *
 * Everything else is one 404 at the call sites, so a grading URL classifies
 * nothing.
 */
final class GradingAccess
{
    public static function canGrade(?User $grader, Attempt $attempt): bool
    {
        if ($grader === null || ! $grader->isActive()) {
            return false;
        }
        $assignment = $attempt->assignment;
        if ($assignment === null) {
            return false;
        }
        $teacher = $assignment->teacher;
        $student = $attempt->student;
        if ($teacher === null || $student === null || ! Connection::acceptedBetween($teacher, $student)) {
            return false;
        }
        if ($grader->id === $teacher->id) {
            return true;
        }

        return $grader->role->gradesForConnectedTeachers()
            && $teacher->isActive()
            && $student->isActive()
            && $teacher->role->authors()
            && Connection::acceptedBetween($grader, $teacher);
    }

    /**
     * The teachers whose assignments `$grader` may grade: themselves when they
     * author, plus every active author they are connected with when their role
     * grades for connected teachers.
     *
     * @return list<User>
     */
    public static function teachersFor(User $grader): array
    {
        $teachers = $grader->role->authors() ? [$grader] : [];
        if ($grader->role->gradesForConnectedTeachers()) {
            $connected = User::whereIn('id', Connection::acceptedCounterpartIds($grader))
                ->whereNull('deactivated_at')
                ->orderBy('id')
                ->get()
                ->filter(fn (User $u) => $u->role->authors() && $u->id !== $grader->id)
                ->all();
            $teachers = [...$teachers, ...$connected];
        }

        return array_values($teachers);
    }
}
