<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory, HasUuids, SoftDeletes, HasUser;

    protected $fillable = [
        'user_id',
        'name',
    ];

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }
}
