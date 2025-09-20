<?php

namespace App\Models\Dictionaries;

use App\Contracts\AvailablePackagesContract;
use App\Contracts\DictionaryContract;
use App\Traits\UseUlids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictionaryColor extends Model implements DictionaryContract, AvailablePackagesContract
{
    const PACKAGE_GENERAL = 'general';

    const PACKAGE_AVATARS = 'avatars';

    const PACKAGE_NOTES = 'notes';

    const PACKAGE_APPEARANCE = 'appearance';

    const PACKAGE_HIGHLIGHT = 'highlight';

    use HasFactory, UseUlids;

    protected $fillable = [
        'label',
        'value',
        'alt_value',
        'package',
        'sort',
    ];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->in;
    }

    /**
     * @return string
     */
    public function getUlid(): string
    {
        return $this->ulid;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string|null
     */
    public function getAltValue(): ?string
    {
        return $this->alt_value;
    }

    /**
     * @return string
     */
    public function getPackage(): string
    {
        return $this->package;
    }

    /**
     * @return int
     */
    public function getSort(): int
    {
        return $this->sort;
    }

    /**
     * @param Builder $query
     * @param string $package
     * @return void
     */
    public function scopeOfPackage(Builder $query, string $package): void
    {
        $query->where('package', $package);
    }

    /**
     * @return string[]
     */
    static public function getPackageCodes(): array
    {
        return [
            self::PACKAGE_GENERAL,
            self::PACKAGE_AVATARS,
            self::PACKAGE_NOTES,
            self::PACKAGE_APPEARANCE,
            self::PACKAGE_HIGHLIGHT,
        ];
    }
}
