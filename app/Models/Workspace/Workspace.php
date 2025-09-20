<?php

namespace App\Models\Workspace;

use App\Models\Dictionaries\DictionaryColor;
use App\Models\Dictionaries\DictionaryIcon;
use App\Models\Module\Module;
use App\Models\User\User;
use App\Models\User\UserWorkspace;
use App\Traits\UseExternalCode;
use App\Traits\UseUlids;
use App\Traits\UseUserBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Workspace extends Model
{
    use HasFactory, UseUlids, SoftDeletes, UseUserBy, UseExternalCode;

    const TYPE_DEFAULT = 10;

    const STATUS_DEFAULT = 10;

    protected $fillable = [
        'owner_id',
        'module_id',
        'type',
        'status',
        'name',
        'description',
        'avatar_color_id',
        'avatar_icon_id',
        'avatar_file_id',
        'created_by',
        'updated_by',
    ];

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, UserWorkspace::class);
    }

    /**
     * @return BelongsTo
     */
    public function avatarColor(): BelongsTo
    {
        return $this->belongsTo(DictionaryColor::class);
    }

    /**
     * @return BelongsTo
     */
    public function avatarIcon(): BelongsTo
    {
        return $this->belongsTo(DictionaryIcon::class);
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
     * @return ?int
     */
    public function getOwnerId(): ?int
    {
        return $this->owner_id;
    }

    /**
     * @return int
     */
    public function getModuleId(): int
    {
        return $this->module_id;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type ?? self::TYPE_DEFAULT;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status ?? self::STATUS_DEFAULT;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return Str::replace(__('enotes.workspace_private_name'), $this->owner->getFullName(), $this->name);
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return int|null
     */
    public function getAvatarColorId(): ?int
    {
        return $this->avatar_color_id;
    }

    /**
     * @return int|null
     */
    public function getAvatarIconId(): ?int
    {
        return $this->avatar_icon_id;
    }

    /**
     * @return int|null
     */
    public function getAvatarFileId(): ?int
    {
        return $this->avatar_file_id;
    }

    /**
     * @return int
     */
    public function getCreatedBy(): int
    {
        return $this->created_by;
    }

    /**
     * @return int
     */
    public function getUpdatedBy(): int
    {
        return $this->updated_by;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->updated_by;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    /**
     * @return bool
     */
    public function isPrivate(): bool
    {
        return $this->getType() === self::TYPE_DEFAULT;
    }

    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        return true;
    }

}
