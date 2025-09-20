<?php

namespace App\Http\Resources\Workspace;

use App\Models\Workspace\Workspace;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkspaceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Workspace $this */

        return [
            'id' => $this->getUlid(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'module' => $this->module->getCode(),
            'private' => $this->isPrivate(),
            'default' => $this->isDefault(),
            'avatar_color_id' => $this->avatarColor ? $this->avatarColor->getUlid() : null,
            'avatar_icon_id' => $this->avatarIcon ? $this->avatarIcon->getUlid() : null,
        ];
    }
}
