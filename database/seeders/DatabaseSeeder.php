<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Account;
use App\Models\CreditCard;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Beny Allan',
            'email' => 'benyallan@gmail.com',
            'password' => 'teste123',
        ]);

        Account::factory()->count(1)->create();
        CreditCard::factory()->count(1)->create();
    }
}
