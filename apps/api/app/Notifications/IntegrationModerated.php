<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class IntegrationModerated extends Notification
{
    use Queueable;

    /** @return array<int, string> */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Deliberately actor-less -- no `user` key -- like the other *Moderated
     * notices: the acting admin is not disclosed, and
     * NotificationController::visible() passes rows with no actor through.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => __('An administrator removed your Anthropic API key.'),
        ];
    }
}
