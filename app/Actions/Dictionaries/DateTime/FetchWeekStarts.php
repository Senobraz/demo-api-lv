<?php

namespace App\Actions\Dictionaries\DateTime;

use App\Actions\Dictionaries\DictionaryAction;
use App\DTO\Dictionaries\DictionaryDTO;
use App\Http\Resources\Dictionaries\DictionaryCollection;
use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FetchWeekStarts extends DictionaryAction
{
    protected mixed $dictionary = [];

    public function execute(array $data): void
    {
        $this->prepare($data);

        foreach (DateHelper::getWeekStartsAtSelect() as $formatValue => $formatLabel) {
            $this->dictionary[] = new DictionaryDTO([
                'label' => $formatLabel,
                'value' => (int)$formatValue,
            ]);
        }
    }

    protected function resource(): ResourceCollection|array|null
    {
        return new DictionaryCollection($this->dictionary);
    }
}
