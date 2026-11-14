<?php

namespace App\Notifications;

use App\Enums\CommentTarget;
use App\Models\Comment;
use App\Support\CommentAccess;
use App\Support\CommentPayload;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

/**
 * To the target's author when someone else comments on it, and to the
 * writer of a comment when someone replies to it. Frozen at write time like
 * every notification here, so the commenter's name is decided for THIS
 * recipient now: named only when CommentAccess would name them on the page.
 */
class CommentPosted extends Notification
{
    use Queueable;

    public function __construct(
        private readonly Comment $comment,
        private readonly CommentTarget $type,
        private readonly int $targetId,
        private readonly string $targetTitle,
        private readonly ?int $testId,
        private readonly bool $isReply,
    ) {}

    /** @return array<int, string> */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /** @return array<string, mixed> */
    public function toArray(object $notifiable): array
    {
        $author = $this->comment->author;
        $data = [
            'comment_id' => $this->comment->id,
            'commenter_role' => $author->role,
            'target_type' => $this->type->value,
            'target_id' => $this->targetId,
            'target_title' => $this->targetTitle,
            'test_id' => $this->testId,
            'is_reply' => $this->isReply,
        ];

        // `user` is the actor key NotificationController::visible() filters
        // on; an unnamed commenter carries none, so the row reads "A student".
        if (CommentAccess::revealsAuthor($author, CommentAccess::namedFor($notifiable))) {
            $data['user'] = CommentPayload::author($author, true);
        }

        return $data;
    }
}
