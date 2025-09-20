<?php

namespace App\Models\Localizations;

use App\Contracts\AvailablePackagesContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localization extends Model implements AvailablePackagesContract
{
    const RU = 'ru';

    const EN = 'en';

    const PACKAGE_GENERAL = 'general';

    const PACKAGE_ACCOUNT = 'account';

    const PACKAGE_NOTES = 'notes';

    const PACKAGE_NOTES_VALIDATE = 'notes-validate';

    const PACKAGE_NOTES_MENU = 'notes-menu';

    const PACKAGE_COLLABORATIVE = 'collaborative';

    const PACKAGE_ALERT = 'alert';

    const PACKAGE_VALIDATE = 'validate';

    const PACKAGE_ERROR = 'error';

    const PACKAGE_MENU = 'menu';

    const PACKAGE_HINT = 'hint';

    const PACKAGE_EDITOR = 'editor';

    use HasFactory;

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $lang
     * @return string
     */
    public function getMessage(string $lang = 'en'): string
    {
        return $this->$lang ?? $this->en;
    }

    /**
     * @return string
     */
    public function getPackage(): string
    {
        return $this->package;
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

    /**
     * @return string[]
     */
    static public function getPackageCodes(): array
    {
        return [
            self::PACKAGE_GENERAL,
            self::PACKAGE_ACCOUNT,
            self::PACKAGE_ALERT,
            self::PACKAGE_VALIDATE,
            self::PACKAGE_ERROR,
            self::PACKAGE_MENU,
            self::PACKAGE_HINT,
            self::PACKAGE_NOTES,
            self::PACKAGE_NOTES_VALIDATE,
            self::PACKAGE_NOTES_MENU,
            self::PACKAGE_COLLABORATIVE,
            self::PACKAGE_EDITOR,
        ];
    }
}
