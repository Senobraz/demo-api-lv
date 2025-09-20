<?php

namespace App\Http\Resources\User;

use App\Helpers\DateHelper;
use App\Models\Account\AccountSettings;
use App\Models\User\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateBasicSettingsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var UserSettings $this */

        return [
            'language' => $this->getLanguageCode(),
            'timezone' => $this->getTimezoneSetting(),
            'date_format' => $this->getDateFormatSetting(),
            'date_format_front' => DateHelper::getDateFormatForFront($this->getDateFormatSetting()),
            'time_format' => $this->getTimeFormatSetting(),
            'time_format_front' => DateHelper::getTimeFormatForFront($this->getTimeFormatSetting()),
            'week_start' => $this->getWeekStartSetting(),
        ];
    }
}
