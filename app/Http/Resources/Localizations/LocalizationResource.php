<?php

namespace App\Http\Resources\Localizations;

use App\Models\Localizations\Localization;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocalizationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Localization $this */

        return [
            'code' => $this->getCode(),
            'package' => $this->getPackage(),
            'message' => $this->getMessage($request->lang),
        ];
    }
}
