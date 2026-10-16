<?php

namespace App\Models;

use App\Enums\GradeLevel;
use App\Enums\Subject;
use App\Enums\Visibility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    protected $fillable = ['title', 'description', 'subject', 'grade_level', 'visibility', 'comment_reactions', 'published_at', 'slug', 'branched_from_id'];

    protected $attributes = ['comment_reactions' => false];

    protected function casts(): array
    {
        return [
            'subject' => Subject::class,
            'grade_level' => GradeLevel::class,
            'visibility' => Visibility::class,
            'comment_reactions' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** The public course this one was branched from, while it exists. */
    public function branchedFrom(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'branched_from_id');
    }

    public function branches(): HasMany
    {
        return $this->hasMany(Course::class, 'branched_from_id');
    }

    /** In display order. */
    public function items(): HasMany
    {
        return $this->hasMany(CourseItem::class)->orderBy('position');
    }

    public function isPublic(): bool
    {
        return $this->visibility === Visibility::Public;
    }
}
