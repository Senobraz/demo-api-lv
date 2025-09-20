<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class TimezoneHelper
{
    static public function getTimezoneGroups(): array
    {
        return [
            [
                'id' => \DateTimeZone::AFRICA,
                'label' => 'Africa',
                'value' => 'africa',
            ],
            [
                'id' => \DateTimeZone::ASIA,
                'label' => 'Asia',
                'value' => 'asia',
            ],
            [
                'id' => \DateTimeZone::AUSTRALIA,
                'label' => 'Australia',
                'value' => 'australia',
            ],
            [
                'id' => \DateTimeZone::AMERICA,
                'label' => 'America',
                'value' => 'america',
            ],
            [
                'id' => \DateTimeZone::EUROPE,
                'label' => 'Europe',
                'value' => 'europe',
            ],
            [
                'id' => \DateTimeZone::PACIFIC,
                'label' => 'Pacific',
                'value' => 'pacific',
            ],
        ];
    }

    static public function getTimezoneList(): array
    {
        return \Cache::remember('timezones_list', 60, function () {
            $timezones = [];

            foreach (self::getTimezoneGroups() as $group) {
                foreach (\DateTimeZone::listIdentifiers($group['id']) as $timezone) {
                    $timezones[] = [
                        'label' => self::getFormatTimezoneWithOffsetUTC($timezone),
                        'value' => $timezone,
                        'group_label' => $group['label'],
                        'group_value' => $group['value'],
                    ];
                }
            }

            $timezones[] = [
                'label' => 'UTC',
                'value' => 'UTC',
            ];

            return $timezones;
        });
    }

    static public function getTimezoneListByGroups(): array
    {
        return \Cache::remember('timezones_list_by_group', 36000, function () {
            $timezones = [];

            foreach (self::getTimezoneGroups() as $group) {
                $item = [
                    'label' => $group['label'],
                    'value' => $group['value'],
                ];

                foreach (\DateTimeZone::listIdentifiers($group['id']) as $timezone) {
                    $item['options'][] = [
                        'label' => self::getFormatTimezoneWithOffsetUTC($timezone),
                        'value' => $timezone,
                        'group_label' => $group['label'],
                        'group_value' => $group['value'],
                    ];
                }

                $timezones[] = $item;
            }

            $timezones[] = [
                'label' => 'UTC',
                'value' => 'UTC',
            ];

            return $timezones;
        });
    }

    static public function getTimezoneOffsetAtMinutes(string $timezone): float
    {
        $dateTimeUTC = new \DateTime('now', new \DateTimeZone('UTC'));

        $dateTimeZone = new \DateTimeZone($timezone);

        return $dateTimeZone->getOffset($dateTimeUTC) / 60;
    }

    static public function getFormatTimezoneWithOffsetUTC(
        string $timezone,
        string $format = '(UTC #UTC_TIME#) #TIMEZONE_NAME#'
    ): string
    {
        $dateTimeUTC = new \DateTime('now', new \DateTimeZone('UTC'));

        $dateTimeZone = new \DateTimeZone($timezone);

        $dateTime = new \DateTime('now', $dateTimeZone);

        $offsetHours = $dateTimeZone->getOffset($dateTimeUTC) / 3600;

        $time = gmdate('h:i', $dateTimeZone->getOffset($dateTimeUTC));

        return Str::replace([
            '#UTC_TIME#',
            '#TIMEZONE_NAME#',
            '#TIMEZONE_TIME#',
        ], [
            $offsetHours > 0 ? "+$time" : "-$time",
            $timezone,
            $dateTime->format('H:i'),
        ], $format);
    }
}
