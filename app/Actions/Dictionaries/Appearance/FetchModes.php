<?php

namespace App\Actions\Dictionaries\Appearance;

use App\Actions\Dictionaries\DictionaryAction;
use App\DTO\Dictionaries\DictionaryDTO;
use App\Http\Resources\Dictionaries\DictionaryCollection;
use App\Supports\AppearanceSupport;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Validation\ValidationException;

class FetchModes extends DictionaryAction
{
    protected mixed $dictionary = [];

    /**
     * @throws ValidationException
     */
    public function execute(array $data): void
    {
        $this->validate($data);

        $this->prepare($data);

        foreach (AppearanceSupport::getAppearanceModes() as $modeValue => $modeLabel) {
            $this->dictionary[] = new DictionaryDTO([
                'label' => $modeLabel,
                'value' => $modeValue,
            ]);
        }
    }

    protected function resource(): ResourceCollection|array|null
    {
        return new DictionaryCollection($this->dictionary);
    }
}
