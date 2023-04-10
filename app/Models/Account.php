<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Account\AccountType;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, HasUuids, SoftDeletes, HasUser;

    protected $fillable = [
        'user_id',
        'bank_id',
        'person_id',
        'description',
        'opening_balance',
        'balance',
        'type',
        'number',
        'account_limit',
    ];

    protected $casts = [
        'opening_balance' => 'decimal:2',
        'balance' => 'decimal:2',
        'account_limit' => 'decimal:2',
        'type' => AccountType::class,
    ];

    protected $appends = [
        'name',
    ];

    protected $attributes = [
        'opening_balance' => 0,
        'balance' => 0,
        'account_limit' => 0,
    ];

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'accountable');
    }

    public function getNameAttribute(): string
    {
        return $this->bank->name.' - '.$this->type->value;
    }
}
