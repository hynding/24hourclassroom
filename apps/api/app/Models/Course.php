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

    protected $fillable = ['title', 'description', 'subject', 'grade_level', 'visibility', 'published_at', 'slug'];

    protected function casts(): array
    {
        return [
            'subject' => Subject::class,
            'grade_level' => GradeLevel::class,
            'visibility' => Visibility::class,
            'published_at' => 'datetime',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
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
