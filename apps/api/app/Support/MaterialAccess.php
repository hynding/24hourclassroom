<?php

namespace App\Support;

use App\Models\Connection;
use App\Models\Material;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Every visibility decision for a material, in one place. Same rule as tests
 * and profiles: a hidden material and a missing material are
 * indistinguishable (404, never 403).
 */
final class MaterialAccess
{
    public static function canView(?User $viewer, Material $material): bool
    {
        if ($viewer && $viewer->id === $material->user_id) {
            return true;
        }

        if (self::hasLiveShare($viewer, $material)) {
            return true;
        }

        return $material->isPublic() && $material->author->isActive();
    }

    /**
     * A share counts only while the connection to the author is ACCEPTED
     * (decision 4): disconnecting hides the material, reconnecting restores
     * it, and the row is never deleted in between.
     *
     * Viewer activity is deliberately NOT checked here. Every authenticated
     * route carries the `active` middleware, and the one route that does not
     * -- the signed download -- resolves a deactivated viewer id to null
     * before calling in (see MaterialFileController).
     */
    public static function hasLiveShare(?User $viewer, Material $material): bool
    {
        if ($viewer === null || $viewer->id === $material->user_id) {
            return false;
        }

        return $material->shares()->where('user_id', $viewer->id)->exists()
            && Connection::acceptedBetween($material->author, $viewer);
    }

    /**
     * Ownership only -- the teacher-role gate is applied at upload. Tying
     * this to `Role::Teacher` would lock an author promoted to admin out of
     * their own materials (the frozen-role defect class).
     */
    public static function canAuthor(?User $user, Material $material): bool
    {
        return $user !== null && $user->id === $material->user_id;
    }

    public static function assertViewer(?User $viewer, Material $material): void
    {
        abort_unless(self::canView($viewer, $material), 404);
    }

    /**
     * 404 if the caller may not even see the material. Otherwise a non-author
     * gets 403 on a PUBLIC one (its existence is already public) and 404 on a
     * private one (a share recipient must not learn it is editable).
     */
    public static function assertAuthor(?User $user, Material $material): void
    {
        self::assertViewer($user, $material);
        if (! self::canAuthor($user, $material)) {
            if ($material->isPublic()) {
                throw new AccessDeniedHttpException();
            }
            abort(404);
        }
    }
}
