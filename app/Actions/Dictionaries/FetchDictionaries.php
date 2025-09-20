<?php

namespace App\Actions\Dictionaries;

use App\Actions\ApiAction;
use App\Validation\Rules\DelimitedRule;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FetchDictionaries extends ApiAction
{
    const DICTIONARY_COLORS = 'colors';

    const DICTIONARY_ICONS = 'icons';

    const DICTIONARY_LANGUAGES = 'languages';

    const DICTIONARY_TIMEZONES = 'timezones';

    const DICTIONARY_DATE_FORMATS = 'date_formats';

    const DICTIONARY_TIME_FORMATS = 'time_formats';

    const DICTIONARY_WEEK_STARTS = 'week_starts';

    const DICTIONARY_APPEARANCE_MODES = 'appearance_modes';

    protected array $dictionaries = [];

    static protected array $map = [
        self::DICTIONARY_COLORS => Colors\Fetch::class,
        self::DICTIONARY_ICONS => Icons\Fetch::class,
        self::DICTIONARY_LANGUAGES => Languages\Fetch::class,
        self::DICTIONARY_TIMEZONES => DateTime\FetchTimezones::class,
        self::DICTIONARY_DATE_FORMATS => DateTime\FetchDateFormats::class,
        self::DICTIONARY_TIME_FORMATS => DateTime\FetchTimeFormats::class,
        self::DICTIONARY_WEEK_STARTS => DateTime\FetchWeekStarts::class,
        self::DICTIONARY_APPEARANCE_MODES => Appearance\FetchModes::class,
    ];

    public function execute(array $data): void
    {
        $this->validate($data);

        $this->prepare($data);

        $values = explode(',', $data['dictionary']);

        $scopes = [];
        foreach ($values as $value) {
            $arr = explode(':', $value);

            $dictionary = $arr[0];

            $package = $arr[1] ?? null;

            if (!isset($scopes[$dictionary])) {
                $scopes[$dictionary] = [];
            }

            if ($package) {
                $scopes[$dictionary][] = $package;
            }
        }

        if ($scopes) {
            foreach ($scopes as $dictionary => $packages) {
                $action = $this->make($dictionary);

                if (!$action) {
                    continue;
                }

                if($packages) {
                    foreach ($packages as $package) {
                        $action->execute([
                            'package' => $package
                        ]);

                        $this->dictionaries[$dictionary . ':' . $package] = $action->resource();
                    }
                } else {
                    $action->execute([]);
                    $this->dictionaries[$dictionary] = $action->resource();
                }
            }
        }
    }

    protected function rules(): array
    {
        return [
            'dictionary' => ['required', 'string', new DelimitedRule($this->getDictionaryWithPackages())],
        ];
    }

    protected function resource(): ResourceCollection|array|null
    {
        return $this->dictionaries;
    }

    protected function make(string $dictionary): ?DictionaryAction
    {
        if (
            !isset(self::$map[$dictionary])
            || !class_exists(self::$map[$dictionary])) {
            return null;
        }

        return new self::$map[$dictionary];
    }

    protected function getDictionaryWithPackages(): array
    {
        $dictionaries = [];

        foreach (self::getDictionaryCodes() as $dictionary) {
            $dictionaries[] = $dictionary;

            $action = $this->make($dictionary);

            if (!$action) {
                continue;
            }

            foreach ($action->getPackages() as $package) {
                $dictionaries[] = $dictionary . ':' . $package;
            }
        }

        return $dictionaries;
    }

    static public function getDictionaryCodes(): array
    {
        return array_keys(self::$map);
    }
}
