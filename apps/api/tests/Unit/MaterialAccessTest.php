<?php

use App\Enums\Role;
use App\Models\User;
use App\Support\MaterialAccess;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

beforeEach(function () {
    Storage::fake(config('materials.disk'));
});

test('the author can always view and author, whatever the visibility', function () {
    $author = aTeacher();
    $private = aMaterial($author);
    $public = aMaterial($author, ['visibility' => 'public', 'published_at' => now()]);

    expect(MaterialAccess::canView($author, $private))->toBeTrue()
        ->and(MaterialAccess::canView($author, $public))->toBeTrue()
        ->and(MaterialAccess::canAuthor($author, $private))->toBeTrue()
        ->and(MaterialAccess::hasLiveShare($author, $private))->toBeFalse();
});

test('a private material is invisible to every other role, logged in or out', function () {
    $material = aMaterial(aTeacher());

    expect(MaterialAccess::canView(null, $material))->toBeFalse();

    foreach (Role::cases() as $role) {
        $viewer = User::factory()->create(['role' => $role->value]);
        expect(MaterialAccess::canView($viewer, $material))->toBeFalse("role {$role->value} could see a private material")
            ->and(MaterialAccess::canAuthor($viewer, $material))->toBeFalse();
    }
});

test('a share is live only while the connection is accepted, for every allowlisted role', function () {
    $author = aTeacher();
    $material = aMaterial($author);

    foreach ([Role::Teacher, Role::Student] as $role) {
        $recipient = User::factory()->create(['role' => $role->value]);
        shareWith($material, $recipient);

        // Share row but no connection: not visible.
        expect(MaterialAccess::canView($recipient, $material))->toBeFalse();

        $connection = connectAccepted($author, $recipient);
        expect(MaterialAccess::hasLiveShare($recipient->fresh(), $material))->toBeTrue()
            ->and(MaterialAccess::canView($recipient->fresh(), $material))->toBeTrue();

        // Disconnecting hides it; the row survives, so reconnecting restores it.
        $connection->delete();
        expect(MaterialAccess::canView($recipient->fresh(), $material))->toBeFalse();
        connectAccepted($author, $recipient);
        expect(MaterialAccess::canView($recipient->fresh(), $material))->toBeTrue();
    }
});

test('a connection with no share row does not open a private material', function () {
    $author = aTeacher();
    $material = aMaterial($author);
    $friend = aTeacher();
    connectAccepted($author, $friend);

    expect(MaterialAccess::canView($friend, $material))->toBeFalse();
});

test('a public material is visible to everyone while its author is active', function () {
    $author = aTeacher();
    $material = aMaterial($author, ['visibility' => 'public', 'published_at' => now()]);

    expect(MaterialAccess::canView(null, $material))->toBeTrue();

    foreach (Role::cases() as $role) {
        expect(MaterialAccess::canView(User::factory()->create(['role' => $role->value]), $material))->toBeTrue();
    }

    $author->forceFill(['deactivated_at' => now()])->save();
    expect(MaterialAccess::canView(null, $material->fresh()))->toBeFalse();
});

test('a deactivated author hides the public path but NOT a live share', function () {
    $author = aTeacher();
    $material = aMaterial($author, ['visibility' => 'public', 'published_at' => now()]);
    $recipient = aStudent();
    shareWith($material, $recipient);
    connectAccepted($author, $recipient);
    $author->forceFill(['deactivated_at' => now()])->save();

    $material = $material->fresh();
    expect(MaterialAccess::canView(null, $material))->toBeFalse()
        ->and(MaterialAccess::canView($recipient, $material))->toBeTrue();
});

test('assertViewer 404s, and assertAuthor is 403 on public and 404 on private', function () {
    $author = aTeacher();
    $private = aMaterial($author);
    $public = aMaterial($author, ['visibility' => 'public', 'published_at' => now()]);
    $stranger = aTeacher();

    expect(fn () => MaterialAccess::assertViewer($stranger, $private))->toThrow(NotFoundHttpException::class);
    expect(fn () => MaterialAccess::assertViewer($stranger, $public))->not->toThrow(NotFoundHttpException::class);

    expect(fn () => MaterialAccess::assertAuthor($stranger, $private))->toThrow(NotFoundHttpException::class);
    expect(fn () => MaterialAccess::assertAuthor($stranger, $public))->toThrow(AccessDeniedHttpException::class);
    expect(fn () => MaterialAccess::assertAuthor(null, $public))->toThrow(AccessDeniedHttpException::class);

    MaterialAccess::assertAuthor($author, $private);
    MaterialAccess::assertAuthor($author, $public);
    expect(true)->toBeTrue(); // reached: the author's asserts did not abort
});
