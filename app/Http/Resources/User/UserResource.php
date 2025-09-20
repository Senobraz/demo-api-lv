<?php

namespace App\Http\Resources\User;

use App\Helpers\StrHelper;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var User $this */

        return [
            'username' => $this->getUserName(),
            'email' => $this->getEmail(),
            'avatar_literal' => StrHelper::getLiteral($this->getUserName()),
            'avatar_default_color' => $this->profile->getAvatarDefaultColor(),
            'avatar_color' => $this->profile->getAvatarColor(),
            'avatar_icon_id' => $this->profile->getAvatarUlid(),
            'avatar_icon_color' => $this->profile->getAvatarIconColor(),
            'email_verified' => $this->isEmailVerified()
        ];
    }
}
