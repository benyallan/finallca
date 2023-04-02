<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory, SoftDeletes, HasUuids, HasUser;

    protected $fillable = [
        'name',
        'email',
    ];

    public function creditCards(): HasMany
    {
        return $this->hasMany(CreditCard::class);
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new UserScope);
    }
}
