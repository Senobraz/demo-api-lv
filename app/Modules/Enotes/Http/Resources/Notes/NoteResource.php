<?php

namespace App\Modules\Enotes\Http\Resources\Notes;

use App\Modules\Enotes\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Note $this */

        return [
            'id' => $this->getUlid(),
            'workspace_id' => $this->workspace->getUlid(),
            'section_id' => $this->section ? $this->section->getUlid() : null,
            'title' => $this->getTitle(),
            'heading' => $this->getHeading(),
            'preview' => $this->getPreview(),
            'color_id' => $this->color ? $this->color->getUlid() : null,
            'sort' => $this->getSort(),
            'created_at' => $this->getCreatedAt()->getTimestampMs(),
            'updated_at' => $this->getUpdatedAt()->getTimestampMs(),
            'updated_content_at' => $this->getUpdatedContentAt()->getTimestampMs(),
        ];
    }
}
