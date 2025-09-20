<?php

namespace App\Actions\Dictionaries\Languages;

use App\Actions\Dictionaries\DictionaryAction;
use App\DTO\Dictionaries\DictionaryDTO;
use App\Models\Localizations\Language;
use App\Http\Resources\Dictionaries\DictionaryCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Validation\ValidationException;

class Fetch extends DictionaryAction
{
    protected mixed $dictionary = [];

    /**
     * @throws ValidationException
     */
    public function execute(array $data): void
    {
        $this->validate($data);

        $this->prepare($data);

        foreach (Language::all() as $language) {
            $this->dictionary[] = new DictionaryDTO([
                'label' => $language->getName(),
                'value' => $language->getCode(),
            ]);
        }
    }

    protected function rules(): array
    {
        return [];
    }

    protected function resource(): ResourceCollection|array|null
    {
        return new DictionaryCollection($this->dictionary);
    }
}
