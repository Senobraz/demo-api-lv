<?php

namespace App\Modules\Enotes\Http\Resources\Sections;

use App\Modules\Enotes\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateOrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Section $this */

        return [
            'id' => $this->getUlid(),
            'sort' => $this->getSort(),
        ];
    }
}
