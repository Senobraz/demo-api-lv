<?php

namespace App\Http\Middleware;

use App\Models\Localizations\Language;
use App\Supports\UserSupport;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Locale
{
    public function handle(Request $request, Closure $next): mixed
    {
        if ($locale = UserSupport::getLocalizationCode()) {
            App::setLocale($locale);
        } elseif ($request->post('language') && in_array($request->post('language'), Language::getLanguageCodes())) {
            App::setLocale($request->post('language'));
        }

        return $next($request);
    }
}
