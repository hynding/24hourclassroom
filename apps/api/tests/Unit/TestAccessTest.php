<?php

use App\Enums\Role;
use App\Models\Assignment;
use App\Models\Connection;
use App\Models\User;
use App\Support\TestAccess;
use Symfony\Component\HttpKernel\Exception\HttpException;

test('acceptedBetween is symmetric and ignores pending rows', function () {
    $a = aTeacher();
    $b = aStudent();
    expect(Connection::acceptedBetween($a, $b))->toBeFalse();

    $row = connectAccepted($a, $b);
    expect(Connection::acceptedBetween($a, $b))->toBeTrue()
        ->and(Connection::acceptedBetween($b, $a))->toBeTrue();

    $row->update(['status' => 'pending']);
    expect(Connection::acceptedBetween($a, $b))->toBeFalse();
});

test('acceptedCounterpartIds folds both directions and excludes pending rows', function () {
    $teacher = aTeacher();
    $outbound = aStudent();   // teacher is the requester
    $inbound = aStudent();    // teacher is the addressee
    $pending = aStudent();
    $stranger = aTeacher();

    connectAccepted($teacher, $outbound);
    connectAccepted($inbound, $teacher);
    Connection::create([
        'requester_id' => $teacher->id,
        'addressee_id' => $pending->id,
        'status' => 'pending',
        'pair_key' => Connection::pairKey($teacher->id, $pending->id),
    ]);

    $ids = Connection::acceptedCounterpartIds($teacher);

    expect($ids)->toHaveCount(2)
        ->and($ids)->toContain($outbound->id)
        ->and($ids)->toContain($inbound->id)
        ->and($ids)->not->toContain($pending->id)
        ->and(Connection::acceptedCounterpartIds($stranger))->toBe([]);
});

test('a private test is visible to its author and assigned students only', function () {
    $author = aTeacher();
    $test = aTestWithQuestions($author);
    $assigned = aStudent();
    Assignment::create(['test_id' => $test->id, 'student_id' => $assigned->id, 'teacher_id' => $author->id]);

    expect(TestAccess::canView($author, $test))->toBeTrue()
        ->and(TestAccess::canView($assigned, $test))->toBeTrue()
        ->and(TestAccess::canView(null, $test))->toBeFalse();

    foreach (Role::cases() as $role) {
        $other = User::factory()->create(['role' => $role->value]);
        expect(TestAccess::canView($other, $test))->toBeFalse();
    }
});

test('a public test is visible to everyone unless its author is deactivated', function () {
    $author = aTeacher();
    $test = aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()]);

    expect(TestAccess::canView(null, $test))->toBeTrue();
    foreach (Role::cases() as $role) {
        expect(TestAccess::canView(User::factory()->create(['role' => $role->value]), $test))->toBeTrue();
    }

    $author->forceFill(['deactivated_at' => now()])->save();
    $test = $test->fresh();
    expect(TestAccess::canView(null, $test))->toBeFalse()
        ->and(TestAccess::canView(aTeacher(), $test))->toBeFalse();

    // An assigned student keeps access even though the author is deactivated.
    $assigned = aStudent();
    Assignment::create(['test_id' => $test->id, 'student_id' => $assigned->id, 'teacher_id' => $author->id]);
    expect(TestAccess::canView($assigned, $test))->toBeTrue();
});

test('only the author sees answers, and authorship survives a role change', function () {
    $author = aTeacher();
    $test = aTestWithQuestions($author);
    expect(TestAccess::canSeeAnswers($author, $test))->toBeTrue()
        ->and(TestAccess::canSeeAnswers(aStudent(), $test))->toBeFalse()
        ->and(TestAccess::canSeeAnswers(null, $test))->toBeFalse();

    $author->update(['role' => 'admin']);
    expect(TestAccess::canAuthor($author->fresh(), $test))->toBeTrue();
});

test('canCopy is true only for another teacher on a public test', function () {
    $author = aTeacher();
    $public = aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()]);
    $private = aTestWithQuestions($author);

    foreach (Role::cases() as $role) {
        $other = User::factory()->create(['role' => $role->value]);
        expect(TestAccess::canCopy($other, $public))->toBe($role === Role::Teacher);
    }

    expect(TestAccess::canCopy($author, $public))->toBeFalse()
        ->and(TestAccess::canCopy(null, $public))->toBeFalse()
        ->and(TestAccess::canCopy(aTeacher(), $private))->toBeFalse();
});

test('assertAuthor is 404 on a private test and 403 on a public one for a non-author', function () {
    $author = aTeacher();
    $private = aTestWithQuestions($author);
    $public = aTestWithQuestions($author, 1, ['visibility' => 'public', 'published_at' => now()]);
    $other = aTeacher();

    try {
        TestAccess::assertAuthor($other, $public);
        $this->fail('expected 403');
    } catch (HttpException $e) {
        expect($e->getStatusCode())->toBe(403);
    }
    try {
        TestAccess::assertAuthor($other, $private);
    } catch (HttpException $e) {
        expect($e->getStatusCode())->toBe(404);
    }
    TestAccess::assertAuthor($author, $private);
    expect(true)->toBeTrue();
});
