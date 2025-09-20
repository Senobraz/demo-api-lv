<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;

class SortHelper
{
    const SORT_DEFAULT_VALUE = 65535;

    static public function getSortValue(): float
    {
        return (float)Carbon::now()->getTimestampMs() / self::SORT_DEFAULT_VALUE;
    }

    static public function calcSortValue(?float $beforeValue, ?float $afterValue): float
    {
        if (!$beforeValue && !$afterValue) {
            return self::getSortValue();
        }

        if (!$beforeValue && $afterValue) {
            return self::getSortValue();
        }

        if (!$afterValue) {
            return ($beforeValue ?? self::getSortValue()) - self::SORT_DEFAULT_VALUE;
        }

        return ($beforeValue + $afterValue) / 2;
    }
}
