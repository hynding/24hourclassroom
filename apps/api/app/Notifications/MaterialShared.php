<?php

namespace App\Notifications;

use App\Models\Material;
use App\Support\UserSummary;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class MaterialShared extends Notification
{
    use Queueable;

    public function __construct(private readonly Material $material) {}

    /** @return array<int, string> */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /** @return array<string, mixed> */
    public function toArray(object $notifiable): array
    {
        // `user` is the actor key NotificationController::visible() filters
        // on, so this notification disappears if the author is deactivated --
        // while the shared material itself stays reachable (decision 4). The
        // same asymmetry TestAssigned has; inherited, recorded.
        return [
            'user' => UserSummary::for($this->material->author),
            'material_id' => $this->material->id,
            'material_title' => $this->material->title,
        ];
    }
}
