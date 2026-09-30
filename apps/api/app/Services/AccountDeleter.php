<?php

namespace App\Services;

use App\Ai\IntegrationTeardown;
use App\Models\Material;
use App\Models\User;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * The ONE way an account goes: the user's own delete (Settings) and the
 * admin's delete both call this.
 *
 * Order matters. The Anthropic teardown runs first and outside any
 * transaction (cache locks, 60 s gateway calls). Materials go next through
 * MaterialDeleter, also outside the outer transaction: its "file only after
 * commit" contract is false inside a savepoint, and rows standing against
 * missing bytes is the one state that is not recoverable. Then one
 * transaction for the rows nothing cascades (notifications, tokens) and the
 * user row itself; the foreign keys cascade the rest. The avatar file is
 * unlinked only after that commit.
 *
 * The lock is a deliberate 120 s, not longer: a crashed holder would wedge
 * the user's own self-delete (which ignores the return value and logs them
 * out) for the whole TTL, and a lapse costs only duplicate no-op deletes.
 */
final class AccountDeleter
{
    /**
     * @return bool false when nothing was deleted: the lock could not be
     *              taken in five seconds (the work inside routinely
     *              outlasts that), or the row was already gone.
     */
    public static function delete(User $user): bool
    {
        $lock = Cache::lock("user-delete:{$user->id}", 120);

        try {
            $lock->block(5);
        } catch (LockTimeoutException) {
            return false;
        }

        try {
            // A concurrent delete won while we waited. Without this check
            // IntegrationTeardown's createOrFirst would hit the integrations
            // foreign key and 500.
            if (User::whereKey($user->id)->doesntExist()) {
                return false;
            }

            app(IntegrationTeardown::class)->forUser($user);

            $user->materials()->cursor()->each(fn (Material $material) => MaterialDeleter::delete($material));

            $avatarPath = $user->profile?->avatar_path;

            DB::transaction(function () use ($user) {
                // notifications.notifiable_id and personal_access_tokens are
                // polymorphic with no foreign key: nothing cascades them.
                $user->notifications()->delete();
                $user->tokens()->delete();
                $user->delete();
            });

            if ($avatarPath !== null && ! Storage::disk('public')->delete($avatarPath)) {
                Log::warning('Failed to delete an avatar file', ['path' => $avatarPath]);
            }

            return true;
        } finally {
            $lock->release();
        }
    }
}
