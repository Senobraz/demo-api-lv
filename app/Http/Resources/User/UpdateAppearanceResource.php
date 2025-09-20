<?php

namespace App\Http\Resources\User;

use App\Models\Account\AccountSettings;
use App\Models\User\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateAppearanceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var UserSettings $this */

        return [
            'appearance_mode' => $this->getAppearanceMode(),
            'appearance_color' => $this->getAppearanceColor(),
        ];
    }
}
