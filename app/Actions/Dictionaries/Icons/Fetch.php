<?php

namespace App\Actions\Dictionaries\Icons;

use App\Models\Dictionaries\DictionaryIcon;
use App\Http\Resources\Dictionaries\DictionaryCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Validation\ValidationException;

class Fetch extends IconAction
{
    const CACHE_TTL = 86400;

    protected mixed $dictionary = [];

    /**
     * @throws ValidationException
     */
    public function execute(array $data): void
    {
        $this->validate($data);

        $this->prepare($data);

        $packages = explode(',', $data['package']);

        $cacheKey = 'dictionary-icons-' . implode('-', $packages);

        $this->dictionary = \Cache::remember($cacheKey, self::CACHE_TTL, function () use ($packages) {
            return DictionaryIcon::whereIn('package', $packages)->get();
        });
    }

    protected function resource(): ResourceCollection|array|null
    {
        return new DictionaryCollection($this->dictionary);
    }
}
