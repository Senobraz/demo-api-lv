<?php

namespace App\Models\Account;

use App\Models\Localizations\Language;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccountSettings extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'account_settings';

    protected $fillable = [
        'account_id',
    ];

    /**
     * @param Builder $query
     * @param int $accountId
     * @return void
     */
    public function scopeOfAccount(Builder $query, int $accountId): void
    {
        $query->where('account_id', $accountId);
    }
}
