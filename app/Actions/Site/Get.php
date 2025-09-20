<?php

namespace App\Actions\Site;

use App\Actions\ApiAction;
use App\Helpers\DateHelper;
use App\Models\User\User;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\App;

class Get extends ApiAction
{
    public function execute(User $user = null): bool
    {
        return true;
    }

    protected function resource(): ResourceCollection|array|null
    {
        $url = 'https://enotespace.ru';

        return [
            'name' => config('app.name'),
            'meta' => [
                'title' => 'Пространство для ваших заметок',
                'description' => 'EnoteSpace – удобный сервис для организации заметок. Создавайте карточки, сортируйте по тегам, ищите мгновенно. Тёмная тема, история изменений и быстрый поиск. Попробуйте бесплатно!',
                'og_title' => 'EnoteSpace – удобный сервис для организации заметок',
                'og_description' => 'Карточки, теги, быстрый поиск и тёмная тема. Удобный сервис для заметок — попробуйте бесплатно!',
                'og_image' => $url . '/preview.png' ,
                'og_url' => $url,
                'og_type' => 'website',

            ],
            'settings' => [
                'language' => App::getLocale(),
                'timezone' => config('app.timezone'),
                'date_format' => DateHelper::getDateFormatForFront(config('app.date_format')),
                'time_format' => DateHelper::getTimeFormatForFront(config('app.time_format')),
                'week_start' => config('app.week_start'),
                'appearance_mode' => config('app.appearance_mode'),
                'appearance_theme' => config('app.appearance_theme'),
                'appearance_color' => config('app.appearance_color'),
            ],
        ];
    }
}
