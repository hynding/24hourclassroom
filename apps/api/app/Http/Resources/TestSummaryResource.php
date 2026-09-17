<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** Row shape for every paginated list of tests. Expects withCount('questions') and author loaded; assignments_count optional. */
class TestSummaryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'subject' => $this->subject,
            'grade_level' => $this->grade_level,
            'visibility' => $this->visibility,
            'published_at' => $this->published_at,
            'question_count' => $this->questions_count,
            'author' => ['id' => $this->author->id, 'name' => $this->author->name],
            'assignment_count' => $this->whenNotNull($this->assignments_count),
        ];
    }
}
