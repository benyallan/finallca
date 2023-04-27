<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreditCardStatement extends Model
{
    use HasFactory, HasUuids, SoftDeletes, HasUser;

    protected $fillable = [
        'user_id',
        'credit_card_id',
        'start_date',
        'end_date',
    ];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    public function creditCard()
    {
        return $this->belongsTo(CreditCard::class);
    }

    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'details');
    }

    public function getLabelAttribute(): string
    {
        return $this->end_date->format('F Y');
    }
}
