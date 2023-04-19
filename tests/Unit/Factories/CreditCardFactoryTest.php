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

        $this->verifyAsserts($creditCard);
    }

    public function testItCanCreateACreditCardWithGivenUser()
    {
        $user = \App\Models\User::factory()->create();
        $creditCard = \App\Models\CreditCard::factory()->forUser($user)->create();

        $this->verifyAsserts($creditCard, ['user' => $user]);
    }

    private function verifyAsserts(App\Models\CreditCard $creditCard, array $data = []): void
    {
        $this->assertNotNull($creditCard);
        $this->assertNotEmpty($creditCard->description);
        $this->assertNotEmpty($creditCard->closing_day);
        $this->assertNotEmpty($creditCard->due_day);
        $this->assertNotEmpty($creditCard->credit_card_limit);
        $this->assertNotEmpty($creditCard->user_id);
        $this->assertIsBool($creditCard->direct_debit);
        $this->assertInstanceOf(\App\Models\User::class, $creditCard->user);
        $this->assertInstanceOf(\App\Models\Person::class, $creditCard->person);

        if (isset($data['user'])) {
            $this->assertEquals($creditCard->user_id, $data['user']->id);
        }

        if (isset($data['person'])) {
            $this->assertEquals($creditCard->person_id, $data['person']->id);
        }
    }
}
