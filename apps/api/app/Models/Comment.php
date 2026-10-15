<?php

namespace App\Models;

use App\Enums\CommentTarget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    protected $fillable = ['user_id', 'parent_id', 'test_id', 'question_id', 'material_id', 'course_id', 'body', 'edited_at'];

    protected function casts(): array
    {
        return ['edited_at' => 'datetime'];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    /** Oldest first, like the top level. */
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id')->orderBy('id');
    }

    public function targetType(): CommentTarget
    {
        foreach (CommentTarget::cases() as $type) {
            if ($this->{$type->column()} !== null) {
                return $type;
            }
        }

        throw new \LogicException("Comment {$this->id} has no target.");
    }

    public function targetId(): int
    {
        return $this->{$this->targetType()->column()};
    }
}
