<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreditCard extends Model
{
    use HasFactory, HasUuids, SoftDeletes, HasUser;

    protected $fillable = [
        'name',
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
    ];

    protected $casts = [
        'closing_day' => 'integer',
        'due_day' => 'integer',
        'account_limit' => 'float',
        'user_id' => 'string',
        'person_id' => 'string',
        'direct_debit' => 'boolean',
    ];

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'accountable');
    }
}
