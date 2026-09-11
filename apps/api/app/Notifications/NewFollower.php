<?php

namespace App\Notifications;

use App\Models\User;
use App\Support\UserSummary;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewFollower extends Notification
{
    use Queueable;

    public function __construct(private readonly User $follower) {}

    /** @return array<int, string> */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /** @return array<string, mixed> */
    public function toArray(object $notifiable): array
    {
        return ['user' => UserSummary::for($this->follower)];
    }
}
