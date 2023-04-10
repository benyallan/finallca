<?php

namespace Database\Factories;

use App\Enums\Transaction\Direction;
use App\Models\Account;
use App\Models\CreditCard;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $accountable = $this->faker->randomElement([
            CreditCard::class,
            Account::class,
        ]);
        return [
            'user_id' => User::factory()->create()->id,
            'accountable_id' => $accountable::factory()->create()->id,
            'accountable_type' => $accountable,
            'description' => $this->faker->sentence,
            'transaction_amount' => $this->faker->randomFloat(2, 0, 1000),
            'due_date' => $this->faker->date(),
            'completed_at' => $this->faker->date(),
            'direction' => $this->faker->randomElement(Direction::getValues()),
        ];
    }
}
