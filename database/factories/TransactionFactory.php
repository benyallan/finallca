<?php

namespace Database\Factories;

use App\Enums\Transaction\Direction;
use App\Models\Account;
use App\Models\CreditCard;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends ModelFactory
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

    /**
     * Indicate that the transaction is a credit.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
     */
    public function credit(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'direction' => Direction::IN,
            ];
        });
    }

    /**
     * Indicate that the transaction is a debit.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
     */
    public function debit(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'direction' => Direction::OUT,
            ];
        });
    }

    /**
     * Indicate that the transaction belongs to an account.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
    */
    public function forAccount(Account $account): self
    {
        return $this->state(function (array $attributes) use ($account) {
            return [
                'accountable_id' => $account->id,
                'accountable_type' => Account::class,
            ];
        });
    }

    /**
     * Indicate that the transaction belongs to a credit card.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
     */
    public function forCreditCard(CreditCard $creditCard): self
    {
        return $this->state(function (array $attributes) use ($creditCard) {
            return [
                'accountable_id' => $creditCard->id,
                'accountable_type' => CreditCard::class,
            ];
        });
    }
}
