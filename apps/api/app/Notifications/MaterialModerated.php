<?php

namespace App\Notifications;

use App\Models\Material;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class MaterialModerated extends Notification
{
    use Queueable;

    public function __construct(private readonly Material $material) {}

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
            'material_id' => $this->material->id,
            'material_title' => $this->material->title,
            'message' => __('An administrator removed ":title" from the public library.', ['title' => $this->material->title]),
        ];
    }
}
