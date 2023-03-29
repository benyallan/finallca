<?php

namespace Database\Factories;

use App\Enums\Transaction\AccountTransactionType;
use App\Enums\Transaction\TransactionDirection;
use App\Enums\Transaction\TransactionStatus;
use App\Models\Account;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccountTransaction>
 */
class AccountTransactionFactory extends ModelFactory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'account_id' => Account::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'description' => $this->faker->sentence,
            'value' => $this->faker->randomFloat(2, 0, 1000),
            'type' => $this->faker->randomElement(AccountTransactionType::getValues()),
            'date' => $this->faker->date(),
            'direction' => $this->faker->randomElement(TransactionDirection::getValues()),
            'status' => $this->faker->randomElement(TransactionStatus::getValues()),
        ];
    }

    public function fromAccount(Account $account): static
    {
        return $this->state(fn (array $attributes) => [
            'account_id' => $account->id,
        ]);
    }
}
