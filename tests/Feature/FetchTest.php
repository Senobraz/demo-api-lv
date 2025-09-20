<?php

namespace Tests\Feature;

use App\Models\Localizations\Localization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class FetchTest extends TestCase
{
    public function test_fetch_app(): void
    {
        $this->authorize();

        $link = URL::route(
            'site.show'
        );

        $response = $this->get($link);

        $response->assertStatus(200);
    }

    public function test_fetch_dictionaries(): void
    {
        $this->authorize();

        $link = URL::route(
            'dictionaries.index',
            [
                'dictionary' => implode(',', [
                    'languages',
                    'timezones:grouped',
                    'timezones:list',
                    'date_formats',
                    'time_formats',
                    'week_starts',
                    'colors:general',
                    'colors:avatars',
                    'colors:notes',
                    'colors:appearance',
                    'icons:general',
                    'icons:section',
                    'icons:avatar',
                ])
            ]
        );

        $response = $this->get($link);

        $response->assertStatus(200);
    }

    public function test_fetch_localizations(): void
    {
        $this->authorize();

        $link = URL::route(
            'localizations.index',
            [
                'lang' => Localization::RU,
                'package' => implode(',', Localization::getPackageCodes())
            ]
        );

        $response = $this->get($link);

        $response->assertStatus(200);
    }
}
