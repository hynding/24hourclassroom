<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialShare extends Model
{
    /** @use HasFactory<\Database\Factories\MaterialShareFactory> */
    use HasFactory;

    protected $fillable = ['material_id', 'user_id'];

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    /** The recipient. */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
