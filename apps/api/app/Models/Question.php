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

    protected $fillable = ['position', 'type', 'prompt', 'stimulus', 'options', 'option_explanations', 'answer', 'points', 'partial_credit', 'auto_grade', 'explanation', 'slug'];

    protected function casts(): array
    {
        return [
            'type' => QuestionType::class,
            'options' => 'array',
            'option_explanations' => 'array',
            // `json`, not `array`: the answer is a scalar for most types.
            'answer' => 'json',
            'points' => 'integer',
            'partial_credit' => 'boolean',
            'auto_grade' => 'boolean',
        ];
    }

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }
}
