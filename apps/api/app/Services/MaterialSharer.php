<?php

namespace App\Services;

use App\Enums\Role;
use App\Models\Connection;
use App\Models\Material;
use App\Models\MaterialShare;
use App\Models\User;
use App\Notifications\MaterialShared;

/**
 * Per-id share eligibility and the write. Same loop shape as
 * AssignmentController::store, with two differences: the role allowlist
 * admits teachers as well as students (a handout is as useful
 * teacher-to-teacher), and the unique-violation race is handled by the
 * framework's `firstOrCreate` (`createOrFirst` as of laravel/framework
 * v12.15.0), which catches the race and re-reads the existing row with
 * `wasRecentlyCreated = false`.
 */
final class MaterialSharer
{
    /**
     * @param  list<int>  $ids
     * @return list<array{id: int, status: string}>
     */
    public static function share(Material $material, User $author, array $ids): array
    {
        $results = [];

        foreach ($ids as $id) {
            $target = User::find($id);

            // Every failure reason collapses to not_found so the caller
            // cannot classify ids (decision 6). Allowlist on role: a denylist
            // over an open enum breaks the next time the enum grows.
            $eligible = $target !== null
                && in_array($target->role, [Role::Teacher, Role::Student], true)
                && $target->isActive()
                && $target->id !== $author->id
                && Connection::acceptedBetween($author, $target);

            if (! $eligible) {
                $results[] = ['id' => (int) $id, 'status' => 'not_found'];

                continue;
            }

            // firstOrCreate (createOrFirst as of laravel/framework
            // v12.15.0) catches the unique-key race itself: a concurrent
            // share of the same id re-reads the existing row with
            // wasRecentlyCreated=false, so the loser never notifies twice.
            // Do not wrap this in a second rescue — the savepoint rollback
            // inside createOrFirst makes one unreachable.
            $share = MaterialShare::firstOrCreate([
                'material_id' => $material->id,
                'user_id' => $target->id,
            ]);

            if ($share->wasRecentlyCreated) {
                $target->notify(new MaterialShared($material));
            }

            $results[] = ['id' => (int) $id, 'status' => 'shared'];
        }

        return $results;
    }
}
