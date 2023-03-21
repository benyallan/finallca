<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreditCardFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanCreateACreditCardWithDefaultAttributes()
    {
        $creditCard = \App\Models\CreditCard::factory()->create();

        $this->assertNotNull($creditCard);
        $this->assertNotEmpty($creditCard->name);
        $this->assertNotEmpty($creditCard->description);
        $this->assertNotEmpty($creditCard->closing_day);
        $this->assertNotEmpty($creditCard->due_day);
        $this->assertNotEmpty($creditCard->limit);
        $this->assertNotEmpty($creditCard->user_id);
        $this->assertIsBool($creditCard->direct_debit);
        $this->assertInstanceOf(\App\Models\User::class, $creditCard->user);
        $this->assertInstanceOf(\App\Models\Bank::class, $creditCard->bank);
        $this->assertInstanceOf(\App\Models\Person::class, $creditCard->person);
    }
}
