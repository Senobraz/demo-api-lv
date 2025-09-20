<?php

namespace App\Models\User;

use App\Models\Localizations\Language;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSettings extends Model
{
    use HasFactory;

    protected $table = 'user_settings';

    protected $fillable = [
        'user_id',
        'account_id',
        'language_id',
        'timezone',
        'date_format',
        'time_format',
        'week_start',
        'appearance_mode',
        'appearance_theme',
        'appearance_color',
    ];

    /**
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getLanguageId(): int
    {
        return $this->language_id;
    }

    /**
     * @return string
     */
    public function getLanguageCode(): string
    {
        return $this->language->code;
    }

    /**
     * @return string
     */
    public function getTimezoneSetting(): string
    {
        return $this->timezone ?? config('app.reg_timezone');
    }

    /**
     * @return string
     */
    public function getDateFormatSetting(): ?string
    {
        return $this->date_format ?? config('app.reg_date_format');
    }

    /**
     * @return string
     */
    public function getTimeFormatSetting(): string
    {
        return $this->time_format ?? config('app.reg_time_format');
    }

    /**
     * @return int
     */
    public function getWeekStartSetting(): int
    {
        return $this->week_start ?? config('app.reg_week_start');
    }

    /**
     * @return int
     */
    public function getAppearanceMode(): string
    {
        return $this->appearance_mode ?? config('app.reg_appearance_mode');
    }

    /**
     * @return string
     */
    public function getAppearanceTheme(): string
    {
        return $this->appearance_theme ?? config('app.reg_appearance_theme');
    }

    /**
     * @return string|null
     */
    public function getAppearanceColor(): ?string
    {
        return $this->appearance_color ?? config('app.reg_appearance_color');
    }

    /**
     * @param Builder $query
     * @param int $accountId
     * @return void
     */
    public function scopeOfAccount(Builder $query, int $accountId): void
    {
        $query->where('account_id', $accountId);
    }

    /**
     * @param Builder $query
     * @param int $userId
     * @return void
     */
    public function scopeOfUser(Builder $query, int $userId): void
    {
        $query->where('user_id', $userId);
    }
}
