<?php

namespace App\Http\Resources;

use App\Support\CoursePayload;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** Row shape for every paginated list of courses. Expects author loaded and the tests_count/materials_count aliases. */
class CourseSummaryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return CoursePayload::summary($this->resource);
    }
}
