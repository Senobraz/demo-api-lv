<?php

namespace App\Http\Resources\User;

use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateAvatarResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var User $this */

        return [
            'avatar_color' => $this->profile->getAvatarColor(),
            'avatar_icon_id' => $this->profile->getAvatarUlid(),
            'avatar_icon_color' => $this->profile->getAvatarIconColor(),
        ];
    }
}
