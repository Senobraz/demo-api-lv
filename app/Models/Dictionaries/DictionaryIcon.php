<?php

namespace App\Models\Dictionaries;

use App\Contracts\AvailablePackagesContract;
use App\Contracts\DictionaryContract;
use App\Traits\UseUlids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictionaryIcon extends Model implements DictionaryContract, AvailablePackagesContract
{
    const PACKAGE_GENERAL = 'general';

    const PACKAGE_SECTION = 'section';

    const PACKAGE_AVATAR = 'avatar';

    const PACKAGE_FEEDBACK = 'feedback';

    use HasFactory, UseUlids;

    protected $fillable = [
        'label',
        'value',
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
            self::PACKAGE_SECTION,
            self::PACKAGE_AVATAR,
            self::PACKAGE_FEEDBACK
        ];
    }
}
