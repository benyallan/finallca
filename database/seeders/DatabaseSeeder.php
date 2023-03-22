<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Account;
use App\Models\Bank;
use App\Models\CreditCard;
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
        User::create([
            'name' => 'Beny Allan',
            'email' => 'benyallan@gmail.com',
            'password' => 'teste123',
        ]);

        User::create([
            'name' => 'Carina Rolim',
            'email' => 'crdo_88@hotmail.com',
            'password' => 'teste123',
        ]);

        $persons = Person::factory(3)->create();

        foreach ($persons as $person) {
            $banks = Bank::factory(2)->create();

            foreach ($banks as $bank) {
                Account::factory(2)->forPerson($person)->fromBank($bank)->create();
            }
            CreditCard::factory(2)->forPerson($person)->withBank()->create();
        }
    }
}
