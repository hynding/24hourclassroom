<?php

namespace App\Notifications;

use App\Models\Attempt;
use App\Services\AttemptGrader;
use App\Support\UserSummary;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AttemptSubmitted extends Notification
{
    use Queueable;

    public function __construct(private readonly Attempt $attempt) {}

    /** @return array<int, string> */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /** @return array<string, mixed> */
    public function toArray(object $notifiable): array
    {
        return [
            'user' => UserSummary::for($this->attempt->student),
            'attempt_id' => $this->attempt->id,
            'test_id' => $this->attempt->test_id,
            'test_title' => $this->attempt->test->title,
            'score' => $this->attempt->score,
            'max_score' => $this->attempt->max_score,
            'ungraded_count' => AttemptGrader::ungradedCount($this->attempt),
        ];
    }
}
