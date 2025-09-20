<?php

namespace App\Http\Resources\Dictionaries;

use App\Contracts\DictionaryContract;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DictionaryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var DictionaryContract $this */

        return [
            'id' => $this->getUlid(),
            'label' => $this->getLabel(),
            'value' => $this->getValue(),
            'alt_value' => $this->getAltValue(),
            'package' => $this->getPackage(),
        ];
    }
}
