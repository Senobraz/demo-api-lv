<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class DateHelper
{
    static public function getDateFormats(): array
    {
        return [
            'd.m.Y' => 'DD.MM.YYYY',
            'd/m/Y' => 'DD/MM/YYYY',
            'm.d.Y' => 'MM.DD.YYYY',
            'm/d/Y' => 'MM.DD.YYYY',
        ];
    }

    static public function getTimeFormats(): array
    {
        return [
            'H:i' => 'HH:mm',
            'h:i a' => 'h:mm a',
        ];
    }

    static public function getDateFormatsAtSelect(): array
    {
        return [
            'd.m.Y' => 'DD.MM.YYYY',
            'd/m/Y' => 'DD/MM/YYYY',
            'm.d.Y' => 'MM.DD.YYYY',
            'm/d/Y' => 'MM.DD.YYYY',
        ];
    }

    static public function getTimeFormatsAtSelect(): array
    {
        return [
            'H:i' => __('calendar.time_format.24'),
            'h:i a' => __('calendar.time_format.12'),
        ];
    }

    static public function getWeekStartsAtSelect(): array
    {
        return [
            '1' => __('calendar.weekday.monday'),
            '0' => __('calendar.weekday.sunday'),
        ];
    }

    static public function getDateFormatForFront($format): string
    {
        $formats = self::getDateFormats();

        return $formats[$format] ?? $format;
    }

    static public function getTimeFormatForFront($format): string
    {
        $formats = self::getTimeFormats();

        return $formats[$format] ?? $format;
    }
}
