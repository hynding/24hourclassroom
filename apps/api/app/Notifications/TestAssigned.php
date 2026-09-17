<?php

namespace App\Notifications;

use App\Models\Assignment;
use App\Support\UserSummary;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TestAssigned extends Notification
{
    use Queueable;

    public function __construct(private readonly Assignment $assignment) {}

    /** @return array<int, string> */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /** @return array<string, mixed> */
    public function toArray(object $notifiable): array
    {
        // `user` is the actor key NotificationController::visible() filters on.
        return [
            'user' => UserSummary::for($this->assignment->teacher),
            'test_id' => $this->assignment->test_id,
            'test_title' => $this->assignment->test->title,
            'assignment_id' => $this->assignment->id,
            'due_at' => $this->assignment->due_at,
        ];
    }
}
