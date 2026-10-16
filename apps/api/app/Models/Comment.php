<?php

namespace App\Models;

use App\Enums\CommentStatus;
use App\Enums\CommentTarget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Soft-deleted: a deleted comment stays for administrators and for no one
 * else (CommentAccess). Deleting the target still removes the rows.
 */
class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'parent_id', 'test_id', 'question_id', 'material_id', 'course_id', 'body', 'status', 'edited_at'];

    protected $attributes = ['status' => 'approved'];

    protected function casts(): array
    {
        return ['edited_at' => 'datetime', 'status' => CommentStatus::class];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** Trashed included: a reply under a deleted comment must know it. */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id')->withTrashed();
    }

    /** Oldest first, like the top level. */
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id')->orderBy('id');
    }

    public function reactions(): HasMany
    {
        return $this->hasMany(Reaction::class);
    }

    public function isApproved(): bool
    {
        return $this->status === CommentStatus::Approved;
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
