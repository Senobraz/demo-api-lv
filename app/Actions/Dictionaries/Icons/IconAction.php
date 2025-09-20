<?php

namespace App\Actions\Dictionaries\Icons;

use App\Actions\Dictionaries\DictionaryAction;
use App\Models\Dictionaries\DictionaryIcon;
use App\Validation\Rules\DelimitedRule;

abstract class IconAction extends DictionaryAction
{
    protected function rules(): array
    {
        return [
            'package' => ['required', 'string', new DelimitedRule($this->getPackages())],
        ];
    }

    public function getPackages(): ?array
    {
        return DictionaryIcon::getPackageCodes();
    }
}
