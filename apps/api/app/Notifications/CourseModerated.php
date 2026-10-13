<?php

namespace App\Notifications;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CourseModerated extends Notification
{
    use Queueable;

    public function __construct(private readonly Course $course) {}

    /** @return array<int, string> */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Actor-less, like TestModerated and MaterialModerated: the acting admin
     * is not disclosed.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'course_id' => $this->course->id,
            'course_title' => $this->course->title,
            'message' => __('An administrator unpublished the course ":title" because it did not meet our guidelines.', ['title' => $this->course->title]),
        ];
    }
}
