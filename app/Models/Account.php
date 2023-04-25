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

class Account extends Accountable
{
    use HasFactory;

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
        'label',
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

    public function getLabelAttribute(): string
    {
        return $this->bank->name.' - '.$this->type->value;
    }
}
