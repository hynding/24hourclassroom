<?php

namespace App\Models;

use App\Enums\CommentReaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/** One person's thumbs up or down on one comment. */
class Reaction extends Model
{
    protected $table = 'comment_reactions';

    protected $fillable = ['comment_id', 'user_id', 'value'];

    protected function casts(): array
    {
        return ['value' => CommentReaction::class];
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }
}
