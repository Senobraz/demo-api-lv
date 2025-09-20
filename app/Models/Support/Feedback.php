<?php

namespace App\Models\Support;

use App\Models\User\User;
use App\Traits\UseUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    use HasFactory, UseUlids;

    const TYPE_DEFAULT = 10;

    protected $table = 'support_feedbacks';

    protected $fillable = [
        'subject',
        'message',
        'type',
        'smile',
        'user_id',
        'account_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getSubject(): string
    {
        return $this->subject ?? '';
    }

    public function getMessage(): string
    {
        return $this->message ?? '';
    }
}
