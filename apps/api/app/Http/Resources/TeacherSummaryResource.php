<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherSummaryResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'school' => $this->profile?->school,
            'subjects' => $this->profile?->subjects ?? [],
            'grade_levels' => $this->profile?->grade_levels ?? [],
            'avatar_url' => $this->profile?->avatar_url,
        ];
    }
}
