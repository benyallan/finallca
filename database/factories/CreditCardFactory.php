<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CreditCard>
 */
class CreditCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->creditCardType,
            'description' => $this->faker->sentence,
            'closing_day' => $this->faker->numberBetween(1, 28),
            'due_day' => $this->faker->numberBetween(1, 28),
            'limit' => $this->faker->randomFloat(2, 100, 10000),
            'user_id' => \App\Models\User::factory(),
            'bank_id' => \App\Models\Bank::factory(),
            'direct_debit' => $this->faker->boolean,
        ];
    }
}
