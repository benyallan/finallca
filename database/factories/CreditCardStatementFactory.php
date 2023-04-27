<?php

namespace Database\Factories;

use App\Models\CreditCard;
use App\Models\User;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CreditCardStatement>
 */
class CreditCardStatementFactory extends ModelFactory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $creditCard = CreditCard::factory()->create();
        $startDate = Carbon::instance($this->faker->dateTimeBetween('-1 year', 'now'));
        $startDate->day($creditCard->closing_day);
        if ($startDate->greaterThan(now())) {
            $startDate->subMonth();
        }
        return [
            'user_id' => User::factory(),
            'credit_card_id' => $creditCard->id,
            'start_date' => $startDate,
            'end_date' => $startDate->copy()->addMonth(),
        ];
    }

    /**
     * Create statement for the given credit card.
     */
    public function forCreditCard(CreditCard $creditCard): self
    {
        return $this->state([
            'credit_card_id' => $creditCard->id,
        ]);
    }

    /**
     * Create statement for the given date.
     */
    public function forDate(Carbon $date): self
    {
        return $this->state([
            'start_date' => $date,
            'end_date' => $date->copy()->addMonth(),
        ]);
    }
}
