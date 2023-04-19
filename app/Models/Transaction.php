<?php

namespace App\Models;

use App\Enums\Transaction\Direction;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes, HasUuids, HasUser;

    protected $fillable = [
        'user_id',
        'related_transaction_id',
        'date',
        'currency_code',
        'transaction_amount',
        'description',
        'done',
        'direction',
        'accountable_type',
        'accountable_id',
    ];

    protected $casts = [
        'date' => 'date',
        'done' => 'boolean',
        'transaction_amount' => 'decimal:2',
        'direction' => Direction::class,
        'accountable_type' => 'string',
        'accountable_id' => 'string',
    ];

    public function accountable(): MorphTo
    {
        return $this->morphTo();
    }

    public function belongingTo(): MorphTo
    {
        return $this->morphTo();
    }
}
