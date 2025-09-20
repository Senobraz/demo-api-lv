<?php

namespace App\DTO\Users;

use App\DTO\BaseDTO;
use App\Helpers\DateHelper;
use App\Models\Localizations\Language;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UpdateSettingsDTO extends BaseDTO
{
    protected string|null $language = null;

    protected string|null $timezone = null;

    protected string|null $dateFormat = null;

    protected string|null $timeFormat = null;

    protected int|string|null $weekStart = null;

    /**
     * @throws ValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->prepare($data);

        $this->language = $data['language'] ?? null;
        $this->timezone = $data['timezone'] ?? null;
        $this->dateFormat = $data['date_format'] ?? null;
        $this->timeFormat = $data['time_format'] ?? null;
        $this->weekStart = $data['week_start'] ?? null;
    }

    public function getLanguageCode(): ?string
    {
        return $this->language;
    }

    public function getLanguageId(): ?string
    {
        return Language::ofCode($this->getLanguageCode())->first()->getId();
    }

    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    public function getDateFormat(): ?string
    {
        return $this->dateFormat;
    }

    public function getTimeFormat(): ?string
    {
        return $this->timeFormat;
    }

    public function getWeekStart(): ?int
    {
        return (int)$this->weekStart;
    }

    public function toArray(): array
    {
        return array_filter([
            'language_id' => $this->getLanguageId(),
            'timezone' => $this->getTimezone(),
            'date_format' => $this->getDateFormat(),
            'time_format' => $this->getTimeFormat(),
            'week_start' => $this->getWeekStart(),
        ], function ($value) {
            return !($value === null);
        });
    }

    protected function rules(): array
    {
        return [
            'language' => ['nullable', 'string', Rule::in(Language::getLanguageCodes())],
            'timezone' => ['nullable', 'timezone:all'],
            'date_format' => ['nullable', Rule::in(array_keys(DateHelper::getDateFormatsAtSelect()))],
            'time_format' => ['nullable', Rule::in(array_keys(DateHelper::getTimeFormatsAtSelect()))],
            'week_start' => ['nullable', Rule::in(array_keys(DateHelper::getWeekStartsAtSelect()))],
        ];
    }
}
