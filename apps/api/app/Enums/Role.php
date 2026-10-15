<?php

namespace App\Enums;

/**
 * Every capability question below is answered by an ALLOWLIST (CLAUDE.md, the
 * recurring defect class): a case added later answers "no" to all of them
 * until someone decides otherwise, here, in one place.
 */
enum Role: string
{
    case Teacher = 'teacher';
    case Student = 'student';
    case Admin = 'admin';
    case Tutor = 'tutor';
    case Assistant = 'assistant';
    case Guardian = 'guardian';

    public function label(): string
    {
        return match ($this) {
            self::Teacher => 'Teacher',
            self::Student => 'Student',
            self::Admin => 'Admin',
            self::Tutor => 'Tutor',
            self::Assistant => 'Teacher assistant',
            self::Guardian => 'Parent or guardian',
        };
    }

    /**
     * Roles a person may pick for themselves, and the only roles the admin
     * role editor offers. Admin is never here: nothing in the application can
     * create an admin.
     *
     * @return list<self>
     */
    public static function selfAssignable(): array
    {
        return [self::Teacher, self::Student, self::Tutor, self::Assistant, self::Guardian];
    }

    /** @return list<string> */
    public static function selfAssignableValues(): array
    {
        return array_map(fn (self $role) => $role->value, self::selfAssignable());
    }

    /**
     * Writes tests, materials and courses, assigns them to connected
     * students, grades them, and uses the integrations (MCP, generation).
     * A tutor does everything a teacher does.
     */
    public function authors(): bool
    {
        return in_array($this, [self::Teacher, self::Tutor], true);
    }

    /**
     * Publicly discoverable: listed in GET /api/teachers, a public profile,
     * followable, an avatar that travels. Everyone else is reachable only
     * through an accepted connection (decision 5).
     */
    public function isPublic(): bool
    {
        return in_array($this, [self::Teacher, self::Tutor], true);
    }

    /** @return list<string> */
    public static function publicValues(): array
    {
        return array_values(array_map(
            fn (self $role) => $role->value,
            array_filter(self::cases(), fn (self $role) => $role->isPublic()),
        ));
    }

    /**
     * May read the assignments and scores of a student they hold an accepted
     * connection with, across every teacher who assigned them work. Read-only:
     * never answers, never a grade change.
     */
    public function supportsStudents(): bool
    {
        return in_array($this, [self::Tutor, self::Assistant, self::Guardian], true);
    }

    /** May receive a material share from a connected author. */
    public function receivesShares(): bool
    {
        return in_array($this, [self::Teacher, self::Student, self::Tutor, self::Assistant], true);
    }

    /**
     * May post comments on anything they can see: tests, their questions,
     * materials and courses. Admin is not here -- an administrator moderates
     * (deletes) a discussion but does not take part in it.
     */
    public function comments(): bool
    {
        return in_array($this, [self::Teacher, self::Student, self::Tutor, self::Assistant, self::Guardian], true);
    }

    /** May delete anyone's comment on anything they can see. */
    public function moderatesComments(): bool
    {
        return in_array($this, [self::Admin], true);
    }

    /**
     * Who may connect with whom. Symmetric, and an allowlist of pairs: an
     * admin pairs with nobody, students never pair with each other, and a
     * guardian pairs with the student and the people teaching them, never
     * with another guardian or an assistant.
     */
    public static function canConnect(self $a, self $b): bool
    {
        $partners = [
            self::Teacher->value => [self::Teacher, self::Student, self::Tutor, self::Assistant, self::Guardian],
            self::Tutor->value => [self::Teacher, self::Student, self::Tutor, self::Assistant, self::Guardian],
            self::Student->value => [self::Teacher, self::Tutor, self::Assistant, self::Guardian],
            self::Assistant->value => [self::Teacher, self::Student, self::Tutor],
            self::Guardian->value => [self::Teacher, self::Student, self::Tutor],
        ];

        return in_array($b, $partners[$a->value] ?? [], true);
    }
}
