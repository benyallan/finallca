<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\CreditCard;
use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreditCardTest extends TestCase
{
    use RefreshDatabase;

    public function testCreditCardHasCorrectAttributes()
    {
        $user = User::factory()->create();
        $person = Person::factory()->create();

        $creditCard = CreditCard::factory()
            ->for($user)
            ->for($person)
            ->create([
                'brand' => 'Visa',
                'description' => 'Cartão de crédito do John',
                'closing_day' => 10,
                'due_day' => 20,
                'credit_card_limit' => 1000,
                'direct_debit' => true,
            ]);

        $this->assertEquals('Visa', $creditCard->brand);
        $this->assertEquals('Cartão de crédito do John', $creditCard->description);
        $this->assertEquals(10, $creditCard->closing_day);
        $this->assertEquals(20, $creditCard->due_day);
        $this->assertEquals(1000.00, $creditCard->credit_card_limit);
        $this->assertEquals($user->id, $creditCard->user_id);
        $this->assertEquals(true, $creditCard->direct_debit);
        $this->assertEquals($person->id, $creditCard->person_id);
    }

    public function testCreditCardCastedAttributes()
    {
        $creditCard = CreditCard::factory()->create();

        $this->assertIsString($creditCard->brand);
        $this->assertIsString($creditCard->description);
        $this->assertIsInt($creditCard->closing_day);
        $this->assertIsInt($creditCard->due_day);
        $this->assertIsString($creditCard->user_id);
        $this->assertIsBool($creditCard->direct_debit);
        $this->assertIsString($creditCard->person_id);
    }
}
