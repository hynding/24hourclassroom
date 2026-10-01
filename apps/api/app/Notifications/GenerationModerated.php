<?php

namespace App\Notifications;

use App\Models\Generation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class GenerationModerated extends Notification
{
    use Queueable;

    public function __construct(private readonly Generation $generation) {}

    /** @return array<int, string> */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Deliberately actor-less -- no `user` key -- like TestModerated: the
     * acting admin is not disclosed, and NotificationController::visible()
     * passes rows with no actor straight through.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'generation_id' => $this->generation->id,
            'generation_title' => $this->generation->title,
            'message' => __('An administrator cancelled the generation ":title".', ['title' => $this->generation->title]),
        ];
    }
}
