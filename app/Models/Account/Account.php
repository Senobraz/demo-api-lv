<?php

namespace App\Models\Account;

use App\Models\Module\Module;
use App\Traits\UseUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, UseUlids, SoftDeletes;

    const STATUS_DEFAULT = 10;

    protected $fillable = [
        'active',
        'status',
        'reg_ip',
        'reg_host',
        'reg_domain',
    ];

    /**
     * @return hasMany
     */
    public function settings(): hasMany
    {
        return $this->hasMany(AccountSettings::class);
    }

    /**
     * @return BelongsToMany
     */
    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class, AccountModule::class);
    }

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
    public function getUlid(): string
    {
        return $this->ulid;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return (bool)$this->active;
    }

    /**
     * @return string | null
     */
    public function getRegIp(): ?string
    {
        return $this->reg_ip;
    }

    /**
     * @return string | null
     */
    public function getRegHost(): ?string
    {
        return $this->reg_host;
    }

    /**
     * @return string | null
     */
    public function getRegDomain(): ?string
    {
        return $this->reg_domain;
    }

    /**
     * @return bool|null
     */
    public function getStatus(): ?bool
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }
}
