<?php

namespace App\Modules\Enotes\Models;

use App\Models\Dictionaries\DictionaryColor;
use App\Models\Dictionaries\DictionaryIcon;
use App\Models\Workspace\Workspace;
use App\Modules\Enotes\Database\Factories\SectionFactory;
use App\Traits\UseUlids;
use App\Traits\UseUserBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class Section extends Model
{
    use HasFactory, UseUlids, SoftDeletes, UseUserBy;

    const TYPE_DEFAULT = 10;

    const TYPE_CATEGORY = 20;

    const STATUS_DEFAULT = 10;

    protected $table = 'enote_sections';

    protected $fillable = [
        'workspace_id',
        'parent_id',
        'level',
        'type',
        'status',
        'name',
        'description',
        'sort',
        'color_id',
        'icon_id',
        'file_id',
    ];

    /**
     * @return BelongsTo
     */
    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * @return BelongsTo
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(DictionaryColor::class);
    }

    /**
     * @return BelongsTo
     */
    public function icon(): BelongsTo
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
     * @return int
     */
    public function getWorkspaceId(): int
    {
        return $this->workspace_id;
    }

    /**
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parent_id;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level ?? 0;
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
        return $this->name;
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
        return $this->color_id;
    }

    /**
     * @return int|null
     */
    public function getAvatarIconId(): ?int
    {
        return $this->icon_id;
    }

    /**
     * @return int|null
     */
    public function getAvatarFileId(): ?int
    {
        return $this->avatar_file_id;
    }

    /**
     * @return float
     */
    public function getSort(): float
    {
        return $this->sort;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at;
    }

    /**
     * @param Builder $query
     * @param int $workspaceId
     * @return void
     */
    public function scopeOfWorkspace(Builder $query, int $workspaceId): void
    {
        $query->where('workspace_id', $workspaceId);
    }

    static protected function newFactory(): SectionFactory
    {
        return SectionFactory::new();
    }
}
