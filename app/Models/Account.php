<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Account\AccountType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }
}
