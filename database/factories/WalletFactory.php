<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wallet>
 */
class WalletFactory extends ModelFactory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'person_id' => Person::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'description' => $this->faker->word,
            'opening_balance' => $this->faker->randomFloat(2, 0, 1000),
            'balance' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }

    /**
     * Indicate that the wallet is a personal wallet.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function personal(Person $person): Factory
    {
        return $this->state(function (array $attributes) use ($person) {
            return [
                'person_id' => $person->id,
            ];
        });
    }
}
