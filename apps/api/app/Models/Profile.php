<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;

    protected $fillable = [
        'bio',
        'school',
        'specialties',
        'subjects',
        'grade_levels',
    ];

    /**
     * The raw storage path is useless to a SPA on another host; `avatar_url` is the public contract.
     *
     * @var list<string>
     */
    protected $hidden = ['avatar_path'];

    /** @var list<string> */
    protected $appends = ['avatar_url'];

    protected function casts(): array
    {
        return [
            'subjects' => 'array',
            'grade_levels' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function avatarUrl(): Attribute
    {
        return Attribute::get(fn (): ?string => $this->avatar_path
            ? Storage::disk('public')->url($this->avatar_path)
            : null);
    }
}
