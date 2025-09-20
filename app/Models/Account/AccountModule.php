<?php

namespace App\Models\Account;

use App\Models\Module\Module;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccountModule extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'account_id',
        'module_id',
    ];

    /**
     * @return BelongsTo
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    /**
     * @return string|null
     */
    public function getModuleCode(): ?string
    {
        return $this->module->code ?? null;
    }

    /**
     * @return string|null
     */
    public function getModuleName(): ?string
    {
        return $this->module->name ?? null;
    }
}
