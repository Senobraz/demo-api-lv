<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class StrHelper
{
    static public function getExternalCode($length = 16): string
    {
        return Str::random($length);
    }

    static public function getFrontendUrl(string $route, array $params = []): string
    {
        $url = url(route($route, $params, false));

        return str_replace(config('app.url'), config('app.frontend_url'), $url);
    }

    static public function getLiteral($text): string
    {
        return mb_substr($text, 0, 1);
    }
}
