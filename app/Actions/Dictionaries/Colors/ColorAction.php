<?php

namespace App\Actions\Dictionaries\Colors;

use App\Actions\Dictionaries\DictionaryAction;
use App\Models\Dictionaries\DictionaryColor;
use App\Validation\Rules\DelimitedRule;

abstract class ColorAction extends DictionaryAction
{
    protected function rules(): array
    {
        return [
            'package' => ['required', 'string', new DelimitedRule($this->getPackages())],
        ];
    }

    public function getPackages(): ?array
    {
        return DictionaryColor::getPackageCodes();
    }
}
