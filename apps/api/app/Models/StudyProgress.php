<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/** One learner's progress on one test or one material. See App\Support\StudyProgress. */
class StudyProgress extends Model
{
    protected $table = 'study_progress';

    protected $fillable = ['user_id', 'test_id', 'material_id', 'best_score', 'best_max', 'last_score', 'last_max', 'runs', 'done_at'];

    protected function casts(): array
    {
        return [
            'best_score' => 'float',
            'best_max' => 'integer',
            'last_score' => 'float',
            'last_max' => 'integer',
            'runs' => 'integer',
            'done_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
