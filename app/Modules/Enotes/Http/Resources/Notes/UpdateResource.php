<?php

namespace App\Modules\Enotes\Http\Resources\Notes;

use App\Modules\Enotes\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Note $this */

        return [
            'id' => $this->getUlid(),
            'preview' => $this->getPreview(),
            'sort' => $this->getSort(),
            'created_at' => $this->getCreatedAt()->getTimestampMs(),
            'updated_at' => $this->getUpdatedAt()->getTimestampMs(),
            'updated_content_at' => $this->getUpdatedContentAt()->getTimestampMs(),
        ];
    }
}
