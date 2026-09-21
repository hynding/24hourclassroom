<?php

namespace App\Http\Resources;

use App\Support\MaterialPayload;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** Row shape for every paginated list of materials. Expects the author relation loaded. */
class MaterialSummaryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return MaterialPayload::summary($this->resource);
    }
}
