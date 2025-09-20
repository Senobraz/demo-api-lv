<?php

namespace App\Models\User;

use App\Models\Dictionaries\DictionaryIcon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'avatar_color',
        'avatar_default_color',
        'avatar_icon_id',
        'avatar_icon_color'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function avatarIcon(): BelongsTo
    {
        return $this->belongsTo(DictionaryIcon::class);
    }

    /**
     * @return string|null
     */
    public function getAvatarDefaultColor(): ?string
    {
        return $this->avatar_default_color;
    }

    /**
     * @return string|null
     */
    public function getAvatarColor(): ?string
    {
        return $this->avatar_color;
    }

    /**
     * @return string|null
     */
    public function getAvatarId(): ?string
    {
        return $this->avatar_icon_id;
    }

    /**
     * @return string|null
     */
    public function getAvatarUlid(): ?string
    {
        return $this->avatarIcon ? $this->avatarIcon->getUlid() : null;
    }

    /**
     * @return string|null
     */
    public function getAvatarIconColor(): ?string
    {
        return $this->avatar_icon_color;
    }
}
