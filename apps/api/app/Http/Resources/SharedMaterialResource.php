<?php

namespace App\Http\Resources;

use App\Support\MaterialPayload;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * A summary row plus when it was shared. `shared_at` is selected as an alias
 * off material_shares.created_at, so it is a plain string on the model.
 */
class SharedMaterialResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return MaterialPayload::summary($this->resource) + ['shared_at' => $this->shared_at];
    }
}
