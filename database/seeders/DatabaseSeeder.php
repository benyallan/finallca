<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Account;
use App\Models\AccountTransaction;
use App\Models\Bank;
use App\Models\CreditCard;
use App\Models\CreditCardTransaction;
use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users[] = User::create([
            'name' => 'Beny Allan',
            'email' => 'benyallan@gmail.com',
            'password' => 'teste123',
        ]);

        $users[] = User::create([
            'name' => 'Carina Rolim',
            'email' => 'crdo_88@hotmail.com',
            'password' => 'teste123',
        ]);
    }
}
