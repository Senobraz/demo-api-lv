<?php

namespace App\Actions\Localizations;

use App\Actions\ApiAction;
use App\DTO\Localizations\FetchLocalizationsDTO;
use App\Http\Resources\Localizations\LocalizationCollection;
use App\Models\Localizations\Localization;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\App;

class Fetch extends ApiAction
{
    const CACHE_TTL = 86400;

    protected mixed $localizations;

    public function execute(FetchLocalizationsDTO $dto): void
    {
        $cacheKey = 'localizations-' . implode('-', $dto->getPackages());

        $this->localizations = \Cache::remember($cacheKey, App::isProduction() ? self::CACHE_TTL : 0, function () use ($dto) {
            return Localization::whereIn('package', $dto->getPackages())->get();
        });
    }

    protected function resource(): ResourceCollection|array|null
    {
        return new LocalizationCollection($this->localizations);
    }
}
