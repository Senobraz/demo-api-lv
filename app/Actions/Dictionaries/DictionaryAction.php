<?php

namespace App\Actions\Dictionaries;

use App\Actions\ApiAction;

abstract class DictionaryAction extends ApiAction
{
    abstract function execute(array $data): void;

    public function getPackages(): ?array
    {
        return [];
    }
}
