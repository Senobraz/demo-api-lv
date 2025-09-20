<?php

namespace App\Modules\Enotes\Models;

use App\Helpers\TiptapHelper;
use App\Models\Dictionaries\DictionaryColor;
use App\Models\Workspace\Workspace;
use App\Traits\UseUlids;
use App\Traits\UseUserBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Laravel\Scout\Searchable;

class Note extends Model
{
    use HasFactory, UseUlids, SoftDeletes, Searchable;

    use UseUserBy;

    const TYPE_DEFAULT = 10;

    protected $table = 'enote_notes';

    protected $fillable = [
        'workspace_id',
        'section_id',
        'title',
        'heading',
        'preview',
        'content',
        'type',
        'color_id',
        'sort',
        'updated_content_at',
    ];

    protected $casts = [
        'updated_content_at' => 'datetime'
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->getId(),
            'workspace_id' => $this->getWorkspaceId(),
            'section_id' => $this->geSectionId(),
            'color_id' => $this->geColorId(),
            'title' => $this->getTitle(),
            'content' => $this->getContent() ? TiptapHelper::getTextByArray($this->getContent()) : '',
        ];
    }

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
    public function section(): BelongsTo
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

    public function collaborative(): HasMany
    {
        return $this->hasMany(NoteCollaborative::class);
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
    public function geSectionId(): ?int
    {
        return $this->section_id;
    }

    /**
     * @return int
     */
    public function geColorId(): ?int
    {
        return $this->color_id;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type ?? self::TYPE_DEFAULT;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title ?? '';
    }

    /**
     * @return array
     */
    public function getHeading(): ?array
    {
        return $this->heading ? json_decode($this->heading, true) : null;
    }

    /**
     * @return array
     */
    public function getPreview(): ?array
    {
        return $this->preview ? json_decode($this->preview, true) : null;
    }

    /**
     * @return array
     */
    public function getContent(): ?array
    {
        return $this->content ? json_decode($this->content, true) : null;
    }

    /**
     * @return float
     */
    public function getSort(): float
    {
        return $this->sort;
    }

    /**
     * @return bool
     */
    public function isShared(): bool
    {
        return $this->shared;
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
     * @return Carbon
     */
    public function getUpdatedContentAt(): Carbon
    {
        return $this->updated_content_at;
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
}
