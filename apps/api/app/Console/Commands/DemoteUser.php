<?php

namespace App\Console\Commands;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Console\Command;

/**
 * The companion to user:promote. The admin UI refuses every action on an
 * admin account (AdminTarget), so removing an admin is: demote here, then
 * use the UI. No --deactivate flag: a demoted admin is immediately
 * actionable and the UI's Deactivate button works, which is the point.
 */
class DemoteUser extends Command
{
    protected $signature = 'user:demote {email}';

    protected $description = 'Demote an admin to teacher by email';

    public function handle(): int
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (! $user) {
            $this->error("No user found with email {$email}.");

            return self::FAILURE;
        }

        if ($user->role !== Role::Admin) {
            $this->error("{$user->email} is not an admin.");

            return self::FAILURE;
        }

        if (User::where('role', Role::Admin)->count() === 1) {
            $this->error('Refusing to demote the only admin.');

            return self::FAILURE;
        }

        // forceFill: only `role` is fillable on User. deactivated_at and
        // email_verified_at are left alone on purpose.
        $user->forceFill(['role' => Role::Teacher])->save();

        $this->info("{$user->email} is now a teacher. Manage them at /admin/users/{$user->id}.");

        // "Only admin" above is a raw row count: a remaining admin that is
        // unverified or deactivated still leaves nobody who can reach /admin.
        $reachable = User::where('role', Role::Admin)
            ->whereNotNull('email_verified_at')
            ->whereNull('deactivated_at')
            ->exists();

        if (! $reachable) {
            $this->warn('The remaining admin(s) cannot reach /admin — see user:promote --verify.');
        }

        return self::SUCCESS;
    }
}
