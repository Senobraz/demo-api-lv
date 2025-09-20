<?php

namespace App\Modules\Enotes\Http\Resources\Sections;

use App\Modules\Enotes\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Section $this */

        return [
            'id' => $this->getUlid(),
            'workspace_id' => $this->workspace->getUlid(),
            'parent_id' => $this->parent ? $this->parent->getUlid() : null,
            'name' => $this->getName(),
            'level' => $this->getLevel(),
            'type' => $this->getType(),
            'sort' => $this->getSort(),
            'created_at' => $this->getCreatedAt()->getTimestampMs(),
            'updated_at' => $this->getUpdatedAt()->getTimestampMs(),
        ];
    }
}
