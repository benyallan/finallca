<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Accountable
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'user_id',
        'description',
        'opening_balance',
        'balance',
    ];

    protected $attributes = [
        'opening_balance' => 0,
        'balance' => 0,
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function getLabelAttribute(): string
    {
        return $this->description;
    }
}
