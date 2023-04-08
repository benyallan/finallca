<?php

namespace App\Models;

use App\Enums\Transaction\Direction;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes, HasUuids, HasUser;

    protected $fillable = [
        'user_id',
        'related_transaction_id',
        'due_date',
        'currency_code',
        'transaction_amount',
        'description',
        'completed_at',
        'direction',
    ];

    protected $casts = [
        'due_date' => 'date',
        'completed_at' => 'date',
        'transaction_amount' => 'decimal:2',
        'direction' => Direction::class,
    ];

    public function accountable()
    {
        return $this->morphTo();
    }

    public function relatedTransaction()
    {
        return $this->belongsTo(Transaction::class, 'related_transaction_id');
    }

    protected function done(): bool
    {
        return $this->completed_at !== null;
    }
}
