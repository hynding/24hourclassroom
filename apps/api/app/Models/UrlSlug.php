<?php

namespace App\Models;

use App\Enums\SlugKind;
use App\Enums\SlugStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * One vanity path segment: a teacher handle or a course slug. Every rule
 * lives in App\Support\Slugs.
 *
 * `scope_id` makes the unique index work: 0 for the site-wide kinds
 * (teacher, site_course), the owning teacher's id for teacher_course.
 */
class UrlSlug extends Model
{
    protected $fillable = ['kind', 'scope_id', 'slug', 'user_id', 'course_id', 'status', 'reviewed_by', 'reviewed_at'];

    protected function casts(): array
    {
        return [
            'kind' => SlugKind::class,
            'status' => SlugStatus::class,
            'reviewed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
