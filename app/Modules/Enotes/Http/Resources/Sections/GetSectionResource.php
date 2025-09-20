<?php

namespace App\Modules\Enotes\Http\Resources\Sections;

use App\Modules\Enotes\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetSectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Section $this */

        return [
            ...(new SectionResource($this))->toArray($request),
            ...['parent' => $this->parent ? (new CategoryResource($this->parent)) : null]
        ];
    }
}
