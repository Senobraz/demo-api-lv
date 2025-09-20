<?php

namespace App\Modules\Enotes\Http\Resources\Sections;

use App\Modules\Enotes\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateMoveResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Section $this */

        return [
            'id' => $this->getUlid(),
            'parent_id' => $this->parent ? $this->parent->getUlid() : null,
            'sort' => $this->getSort(),
        ];
    }
}
