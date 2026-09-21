<?php

namespace App\Http\Resources;

use App\Support\AttemptPayload;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** One assignment row on the author's results page. Expects student + attempts loaded. */
class AssignmentResultResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'assignment_id' => $this->id,
            'student' => ['id' => $this->student->id, 'name' => $this->student->name],
            'due_at' => $this->due_at,
            'attempts' => $this->attempts->sortByDesc('id')->values()->map(fn ($a) => AttemptPayload::summary($a))->all(),
            ...AttemptPayload::latestAndBest($this->attempts),
        ];
    }
}
