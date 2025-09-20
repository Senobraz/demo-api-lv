<?php

namespace App\Modules\Enotes\Models;

use App\Models\User\User;
use App\Traits\UseUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class NoteCollaborative extends Model
{
    use HasFactory, UseUlids, SoftDeletes;

    const TYPE_DEFAULT = 10;

    const ACCEPT_DEFAULT = 10;

    protected $table = 'enote_collaborative_notes';

    protected $fillable = [
        'active',
        'public_active',
        'public_key',
        'public_code',
        'public_url',
        'public_date',
        'type',
        'accept',
        'note_id',
        'note_ulid',
        'owner_id',
        'supplier_id',
        'author_id',
        'share_count',
        'view_count',
        'sort'
    ];

    protected $casts = [
        'public_date' => 'datetime'
    ];

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * @return BelongsTo
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * @return BelongsTo
     */
    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class);
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
    public function getNoteId(): int
    {
        return $this->note_id;
    }

    /**
     * @return string
     */
    public function getNoteUlid(): string
    {
        return $this->note_ulid;
    }

    /**
     * @return int
     */
    public function getOwnerId(): int
    {
        return $this->owner_id;
    }

    /**
     * @return int
     */
    public function getSupplierId(): int
    {
        return $this->supplier_id;
    }

    /**
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->author_id;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return (bool)$this->active;
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
    public function getAccept(): int
    {
        return $this->accept ?? self::ACCEPT_DEFAULT;
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
    public function isPublicActive(): bool
    {
        return (bool)$this->public_active;
    }

    /**
     * @return string
     */
    public function getPublicKey(): string
    {
        return $this->public_key;
    }

    /**
     * @return string
     */
    public function getPublicCode(): string
    {
        return $this->public_code;
    }

    /**
     * @return string
     */
    public function getPublicUrl(): string
    {
        return $this->public_url;
    }


    public function getPublicDate(): Carbon
    {
        return $this->public_date;
    }

    /**
     * @return int
     */
    public function getShareCount(): int
    {
        return $this->share_count;
    }

    /**
     * @return int
     */
    public function getViewCount(): int
    {
        return $this->view_count;
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
}
