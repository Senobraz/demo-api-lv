<?php

namespace App\Modules\Enotes\Http\Resources\Share\Notes;

use App\Modules\Enotes\Models\NoteCollaborative;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var NoteCollaborative $this */

        return [
            'id' => $this->note->getUlid(),
            'public_active' => $this->isPublicActive(),
            'public_url' => $this->getPublicUrl(),
        ];
    }
}
