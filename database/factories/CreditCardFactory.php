<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CreditCard>
 */
class CreditCardFactory extends ModelFactory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand' => $this->faker->creditCardType,
            'description' => $this->faker->sentence,
            'closing_day' => $this->faker->numberBetween(1, 28),
            'due_day' => $this->faker->numberBetween(1, 28),
            'account_limit' => $this->faker->randomFloat(2, 100, 10000),
            'user_id' => \App\Models\User::factory(),
            'bank_id' => \App\Models\Bank::factory(),
            'direct_debit' => $this->faker->boolean,
            'person_id' => \App\Models\Person::factory(),
        ];
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

    public function withoutBank(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'bank_id' => null,
            ];
        });
    }
}
