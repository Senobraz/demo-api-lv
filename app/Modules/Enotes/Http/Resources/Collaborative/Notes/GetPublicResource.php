<?php

namespace App\Modules\Enotes\Http\Resources\Collaborative\Notes;

use App\Modules\Enotes\Models\NoteCollaborative;
use App\Modules\Enotes\Supports\CollaborativeResourceSupport;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetPublicResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var NoteCollaborative $this */

        return [
            'id' => $this->getUlid(),
            /*
             * Draft
             'owner' => [
                'username' => $this->owner->getUserName(),
                'avatar_literal' => StrHelper::getLiteral($this->owner->getUserName()),
                'avatar_color' => $this->owner->profile->getAvatarColor() ?? $this->owner->profile->getAvatarDefaultColor(),
                'avatar_icon_ulid' => $this->owner->profile->getAvatarUlid(),
                'avatar_icon_color' => $this->owner->profile->getAvatarIconColor(),
            ],
            */
            'metadata' => CollaborativeResourceSupport::getPublicNoteMeta($this->note),
            'owner' => null,
            'content' => [
                'title' => $this->note->getTitle(),
                'heading' => $this->note->getHeading(),
                'content' => $this->note->getContent(),
                'public_at' => $this->getPublicDate()->getTimestampMs(),
                'created_at' => $this->note->getCreatedAt()->getTimestampMs(),
                'updated_at' => $this->note->getUpdatedAt()->getTimestampMs(),
                'updated_content_at' => $this->note->getUpdatedContentAt()->getTimestampMs(),
            ],
        ];
    }
}
