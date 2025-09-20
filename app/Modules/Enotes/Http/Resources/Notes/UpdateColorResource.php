<?php

namespace App\Modules\Enotes\Http\Resources\Notes;

use App\Modules\Enotes\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateColorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Note $this */

        return [
            'id' => $this->getUlid(),
            'color_id' => $this->color ? $this->color->getUlid() : null,
            'updated_at' => $this->getUpdatedAt()->getTimestampMs(),
        ];
    }
}
