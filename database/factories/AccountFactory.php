<?php

namespace Database\Factories;

use App\Enums\Account\AccountType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends ModelFactory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->name,
            'opening_balance' => $this->faker->randomFloat(2, 0, 1000),
            'balance' => $this->faker->randomFloat(2, 0, 1000),
            'type' => $this->faker->randomElement(AccountType::getValues()),
            'number' => $this->faker->numberBetween(100000, 999999),
            'account_limit' => $this->faker->randomFloat(2, 0, 1000),
            'income' => $this->faker->boolean,
            'maintenance_fee' => $this->faker->randomFloat(2, 0, 10),
            'user_id' => \App\Models\User::factory(),
            'bank_id' => \App\Models\Bank::factory(),
            'person_id' => \App\Models\Person::factory(),
        ];
    }

    /**
     * Indicate that the account is of type current account.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
     */
    public function ofType(AccountType $accountType): Factory
    {
        return $this->state(function (array $attributes) use ($accountType) {
            return [
                'type' => $accountType,
            ];
        });
    }

    public function fromBank(\App\Models\Bank $bank): Factory
    {
        return $this->state(function (array $attributes) use ($bank) {
            return [
                'bank_id' => $bank->id,
            ];
        });
    }

    public function forPerson(\App\Models\Person $person): Factory
    {
        return $this->state(function (array $attributes) use ($person) {
            return [
                'person_id' => $person->id,
            ];
        });
    }

    public function forUser(\App\Models\User $user): Factory
    {
        return $this->state(function (array $attributes) use ($user) {
            return [
                'user_id' => $user->id,
            ];
        });
    }
}
