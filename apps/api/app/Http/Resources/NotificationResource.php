<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * The wire shape of a database notification.
 *
 * Exists for two reasons. First, the envelope: a bare `->paginate()` serialises
 * flat (`last_page` at the top level), while @24hc/shared's `Paginated<T>` --
 * and every other paginated endpoint on this API, `GET /api/teachers` included
 * -- nests it under `meta`. A resource collection produces that envelope.
 * Second, the row: the stock model also carries `notifiable_id`,
 * `notifiable_type`, `updated_at` and `sequence`, none of which the client has
 * any business seeing.
 */
class NotificationResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'read_at' => $this->read_at,
            'created_at' => $this->created_at,
            'data' => $this->data,
        ];
    }
}
