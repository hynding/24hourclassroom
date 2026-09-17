<?php

namespace App\Console\Commands;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Console\Command;

class PromoteUser extends Command
{
    protected $signature = 'user:promote {email} {--verify}';

    protected $description = 'Promote a user to admin by email';

    public function handle(): int
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (! $user) {
            $this->error("No user found with email {$email}.");

            return self::FAILURE;
        }

        $attributes = ['role' => Role::Admin];

        // The admin surface is gated on `auth`, `verified`, `active`, `admin`
        // (routes/web.php), so the role alone is not enough to get in. With
        // MAIL_MAILER=log in the deployed environments the verification mail
        // never reaches an inbox, which is why clearing those two gates is
        // offered here rather than left to a hand-written tinker session.
        if ($this->option('verify')) {
            $attributes['email_verified_at'] = $user->email_verified_at ?? now();
            $attributes['deactivated_at'] = null;
        }

        // forceFill: only `role` is fillable on User.
        $user->forceFill($attributes)->save();

        $this->info("{$user->email} is now an admin.");

        // Role alone does not grant access, and the failure mode is a silent
        // 403 with no hint as to which gate closed. Name them here instead.
        $blockers = array_filter([
            $user->email_verified_at === null ? 'email is not verified' : null,
            $user->deactivated_at !== null ? 'account is deactivated' : null,
        ]);

        foreach ($blockers as $blocker) {
            $this->warn("Cannot reach /admin yet: {$blocker}.");
        }

        if ($blockers !== []) {
            $this->warn('Re-run with --verify to clear this.');
        }

        return self::SUCCESS;
    }
}
