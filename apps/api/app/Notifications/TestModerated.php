<?php

namespace App\Notifications;

use App\Models\Test;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TestModerated extends Notification
{
    use Queueable;

    public function __construct(private readonly Test $test) {}

    /** @return array<int, string> */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /** @return array<string, mixed> */
    public function toArray(object $notifiable): array
    {
        return [
            'test_id' => $this->test->id,
            'test_title' => $this->test->title,
            'message' => __('An administrator unpublished ":title" because it did not meet our guidelines.', ['title' => $this->test->title]),
        ];
    }
}
