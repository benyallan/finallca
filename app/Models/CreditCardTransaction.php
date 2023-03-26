<?php

namespace App\Models;

use App\Enums\Transaction\CreditCardTransactionType;
use App\Enums\Transaction\TransactionDirection;
use App\Enums\Transaction\TransactionStatus;
use App\Models\Scopes\UserScope;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreditCardTransaction extends Model
{
    use HasFactory, HasUuids, HasUser, SoftDeletes;

    protected $fillable = [
        'user_id',
        'credit_card_id',
        'description',
        'value',
        'type',
        'date',
        'direction',
        'status',
    ];

    protected $casts = [
        'user_id' => 'string',
        'credit_card_id' => 'string',
        'value' => 'decimal:2',
        'date' => 'date',
        'direction' => TransactionDirection::class,
        'status' => TransactionStatus::class,
        'type' => CreditCardTransactionType::class,
    ];

    public function creditCard()
    {
        return $this->belongsTo(CreditCard::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new UserScope);
    }
}
