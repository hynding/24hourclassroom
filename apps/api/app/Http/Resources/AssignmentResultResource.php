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
        // Sorted by id descending before use, not just for display: submitted_at
        // has only second precision, so two attempts submitted in the same
        // second tie there, and latestAndBest's stable sort then keeps
        // whatever order it's handed -- feeding it newest-id-first makes that
        // tie resolve to the actually-latest attempt instead of the earliest.
        $attempts = $this->attempts->sortByDesc('id')->values();

        return [
            'assignment_id' => $this->id,
            'student' => ['id' => $this->student->id, 'name' => $this->student->name],
            'due_at' => $this->due_at,
            'attempts' => $attempts->map(fn ($a) => AttemptPayload::summary($a))->all(),
            ...AttemptPayload::latestAndBest($attempts),
        ];
    }
}
