<?php

namespace App\Modules\Enotes\Models;

use App\Traits\UseUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class NoteReport extends Model
{
    use HasFactory, UseUlids, SoftDeletes;

    const TYPE_DEFAULT = 10;

    const TYPE_SPAM = 20;

    const TYPE_INAPPROPRIATE_CONTENT = 30;

    const TYPE_OTHER = 40;

    protected $table = 'enote_report_notes';

    protected $fillable = [
        'note_id',
        'note_ulid',
        'type',
        'ip',
        'text'
    ];

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
    public function getType(): int
    {
        return $this->type ?? self::TYPE_DEFAULT;
    }

    /**
     * @return string|null
     */
    public function getIp(): ?string
    {
        return $this->ip;
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
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
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
     * @return int[]
     */
    static public function getTypeCodes(): array
    {
        return [
            self::TYPE_SPAM,
            self::TYPE_INAPPROPRIATE_CONTENT,
            self::TYPE_OTHER,
        ];
    }
}
