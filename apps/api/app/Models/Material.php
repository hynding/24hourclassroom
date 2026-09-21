<?php

namespace App\Models;

use App\Enums\GradeLevel;
use App\Enums\Subject;
use App\Enums\Visibility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    /** @use HasFactory<\Database\Factories\MaterialFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'description', 'subject', 'grade_level',
        'visibility', 'original_name', 'path', 'mime_type', 'size_bytes', 'published_at',
    ];

    protected function casts(): array
    {
        return [
            'subject' => Subject::class,
            'grade_level' => GradeLevel::class,
            'visibility' => Visibility::class,
            'published_at' => 'datetime',
            'size_bytes' => 'int',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shares(): HasMany
    {
        return $this->hasMany(MaterialShare::class);
    }

    public function isPublic(): bool
    {
        return $this->visibility === Visibility::Public;
    }
}
