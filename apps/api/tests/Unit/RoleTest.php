<?php

use App\Enums\Role;

/*
 * Every capability spelled out per role. A role added later must be added
 * here too, or the first test fails -- which is the point: its answers are
 * a decision, not a default.
 */
dataset('capabilities', [
    //                 authors, isPublic, supportsStudents, receivesShares, selfAssignable
    'teacher' => [Role::Teacher, true, true, false, true, true],
    'student' => [Role::Student, false, false, false, true, true],
    'admin' => [Role::Admin, false, false, false, false, false],
    'tutor' => [Role::Tutor, true, true, true, true, true],
    'assistant' => [Role::Assistant, false, false, true, true, true],
    'guardian' => [Role::Guardian, false, false, true, false, true],
]);

test('the capability table covers every case', function () {
    expect(array_column(Role::cases(), 'value'))
        ->toBe(['teacher', 'student', 'admin', 'tutor', 'assistant', 'guardian']);
});

test('each role answers its capabilities exactly', function (Role $role, bool $authors, bool $public, bool $supports, bool $shares, bool $self) {
    expect($role->authors())->toBe($authors)
        ->and($role->isPublic())->toBe($public)
        ->and($role->supportsStudents())->toBe($supports)
        ->and($role->receivesShares())->toBe($shares)
        ->and(in_array($role, Role::selfAssignable(), true))->toBe($self);
})->with('capabilities');

test('publicValues and selfAssignableValues agree with their predicates', function () {
    expect(Role::publicValues())->toBe(['teacher', 'tutor'])
        ->and(Role::selfAssignableValues())->toBe(['teacher', 'student', 'tutor', 'assistant', 'guardian']);
});

test('the connection matrix is exactly this, and symmetric', function () {
    // Rows connect with the listed columns; everything else is refused.
    $allowed = [
        'teacher' => ['teacher', 'student', 'tutor', 'assistant', 'guardian'],
        'student' => ['teacher', 'tutor', 'assistant', 'guardian'],
        'admin' => [],
        'tutor' => ['teacher', 'student', 'tutor', 'assistant', 'guardian'],
        'assistant' => ['teacher', 'student', 'tutor'],
        'guardian' => ['teacher', 'student', 'tutor'],
    ];

    foreach (Role::cases() as $a) {
        foreach (Role::cases() as $b) {
            $expected = in_array($b->value, $allowed[$a->value], true);
            expect(Role::canConnect($a, $b))->toBe($expected, "{$a->value} <-> {$b->value}")
                ->and(Role::canConnect($b, $a))->toBe($expected, "{$b->value} <-> {$a->value} is not symmetric");
        }
    }
});

test('every case has a label', function () {
    foreach (Role::cases() as $role) {
        expect($role->label())->not->toBe('');
    }
});
