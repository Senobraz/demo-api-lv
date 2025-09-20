<?php

namespace App\Models\Localizations;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Module\Module;

class Language extends Model
{
    use HasFactory;

    const RU = 'ru';

    const EN = 'en';

    public $incrementing = true;

    public $timestamps = false;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param Builder $query
     * @param string $code
     * @return void
     */
    public function scopeOfCode(Builder $query, string $code): void
    {
        $query->where('code', $code);
    }

    /**
     * @return string[]
     */
    static public function getLanguageCodes(): array
    {
        return [
            self::RU,
            self::EN,
        ];
    }
}
