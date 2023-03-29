<?php

namespace Database\Factories;

use App\Enums\Transaction\CreditCardTransactionType;
use App\Enums\Transaction\TransactionDirection;
use App\Enums\Transaction\TransactionStatus;
use App\Models\CreditCard;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CreditCardTransaction>
 */
class CreditCardTransactionFactory extends ModelFactory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'credit_card_id' => CreditCard::factory(),
            'description' => $this->faker->sentence,
            'value' => $this->faker->randomFloat(2, 0, 1000),
            'type' => $this->faker->randomElement(CreditCardTransactionType::getValues()),
            'date' => $this->faker->date(),
            'direction' => $this->faker->randomElement(TransactionDirection::getValues()),
            'status' => $this->faker->randomElement(TransactionStatus::getValues()),
        ];
    }

    public function fromCreditCard(CreditCard $creditCard): self
    {
        return $this->state([
            'credit_card_id' => $creditCard->id,
        ]);
    }
}
