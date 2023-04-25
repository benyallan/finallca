<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class Accountable extends Model
{
    use HasUuids, HasUser, SoftDeletes;

    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'accountable');
    }

    abstract public function getLabelAttribute(): string;
}

