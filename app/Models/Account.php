<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Account\AccountType;
use App\Models\Scopes\UserScope;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, HasUuids, SoftDeletes, HasUser;

    protected $fillable = [
        'description',
        'opening_balance',
        'balance',
        'type',
        'number',
        'limit',
        'income',
        'maintenance_fee',
    ];

    protected $casts = [
        'opening_balance' => 'double',
        'balance' => 'double',
        'limit' => 'double',
        'income' => 'boolean',
        'maintenance_fee' => 'float',
        'type' => AccountType::class,
    ];

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new UserScope);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(AccountTransaction::class);
    }
}
