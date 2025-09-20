<?php

namespace App\Supports;

use App\Models\Dictionaries\DictionaryColor;

class AppearanceSupport
{
    const string APPEARANCE_MODE_SYSTEM = 'system';

    const string APPEARANCE_MODE_LIGHT = 'light';

    const string APPEARANCE_MODE_DARK = 'dark';

    static public function getAppearanceModes(): array
    {
        return [
            self::APPEARANCE_MODE_LIGHT => __('appearance.mode.light'),
            self::APPEARANCE_MODE_DARK => __('appearance.mode.dark'),
            self::APPEARANCE_MODE_SYSTEM => __('appearance.mode.system'),
        ];
    }

    static public function getAppearanceColors(): array
    {
        $colors = [];

        $dictionaryCollection = DictionaryColor::ofPackage(DictionaryColor::PACKAGE_APPEARANCE)->get();

        foreach ($dictionaryCollection as $item) {
            $colors[$item->getAltValue()] = $item->getLabel();
        }

        return $colors;
    }
}
