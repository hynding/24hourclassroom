<?php

namespace App\Models;

use App\Enums\QuestionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['position', 'type', 'prompt', 'options', 'answer', 'points', 'partial_credit', 'explanation'];

    protected function casts(): array
    {
        return [
            'type' => QuestionType::class,
            'options' => 'array',
            // `json`, not `array`: the answer is a scalar for most types.
            'answer' => 'json',
            'points' => 'integer',
            'partial_credit' => 'boolean',
        ];
    }

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }
}
