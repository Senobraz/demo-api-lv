<?php

namespace App\Http\Resources\Auth;

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
        ];
    }
}
