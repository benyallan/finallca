<?php

namespace App\Models;

use App\Enums\Transaction\AccountTransactionStatus;
use App\Enums\Transaction\AccountTransactionType;
use App\Enums\Transaction\TransactionDirection;
use App\Models\Scopes\UserScope;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountTransaction extends Model
{
    use HasFactory, HasUuids, SoftDeletes, HasUser;

    protected $fillable = [
        'account_id',
        'user_id',
        'description',
        'value',
        'type',
        'date',
        'direction',
        'status',
    ];

    protected $casts = [
        'id' => 'string',
        'account_id' => 'string',
        'user_id' => 'string',
        'type' => AccountTransactionType::class,
        'direction' => TransactionDirection::class,
        'status' => AccountTransactionStatus::class,
        'value' => 'decimal:2',
        'date' => 'date',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new UserScope);
    }
}
