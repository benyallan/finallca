<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfer extends Model
{
    use HasFactory, SoftDeletes, HasUuids, HasUser;

    protected $fillable = [
        'user_id',
        'sender_id',
        'destination_id',
    ];

    public function sender(): MorphOne
    {
        return $this->morphOne(Transaction::class, 'belonging_to');
    }

    public function destination(): MorphOne
    {
        return $this->morphOne(Transaction::class, 'belonging_to');
    }
}
