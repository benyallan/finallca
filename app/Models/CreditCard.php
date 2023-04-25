<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreditCard extends Accountable
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'credit_card_limit',
        'person_id',
        'description',
        'closing_day',
        'due_day',
        'account_limit',
        'user_id',
        'bank_id',
        'direct_debit',
        'accountable_type',
        'accountable_id',
    ];

    protected $casts = [
        'closing_day' => 'integer',
        'due_day' => 'integer',
        'account_limit' => 'decimal:2',
        'user_id' => 'string',
        'person_id' => 'string',
        'direct_debit' => 'boolean',
        'accountable_type' => 'string',
        'accountable_id' => 'string',
    ];

    protected $appends = [
        'label',
    ];

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function getLabelAttribute(): string
    {
        return $this->description;
    }
}
