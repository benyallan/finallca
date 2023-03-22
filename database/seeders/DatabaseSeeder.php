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

        $this->createDataForUser($users);
    }

    private function createDataForUser(array|User $user): void
    {
        if ($user instanceof User) {
            $persons = Person::factory(3)->forUser($user)->create();

            foreach ($persons as $person) {
                $banks = Bank::factory(2)
                    ->forUser($user)
                    ->create();

                foreach ($banks as $bank) {
                    Account::factory(2)
                        ->forPerson($person)
                        ->forUser($user)
                        ->fromBank($bank)
                        ->create();
                }
                CreditCard::factory(2)
                    ->forPerson($person)
                    ->forUser($user)
                    ->withBank()
                    ->create();
            }
            return;
        }

        foreach ($user as $user) {
            $this->createDataForUser($user);
        }
    }
}
