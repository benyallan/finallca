<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\CreditCard;
use App\Models\Bank;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CreditCardTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate:fresh --seed');
    }

    public function testCreditCardHasCorrectAttributes()
    {
        $user = User::factory()->create();
        $bank = Bank::factory()->create();

        $creditCard = CreditCard::factory()->create([
            'name' => 'Cartão do John',
            'description' => 'Cartão de crédito do John',
            'closing_day' => 10,
            'due_day' => 20,
            'limit' => 1000,
            'user_id' => $user->id,
            'bank_id' => $bank->id,
            'direct_debit' => true,
        ]);

        $this->assertEquals('Cartão do John', $creditCard->name);
        $this->assertEquals('Cartão de crédito do John', $creditCard->description);
        $this->assertEquals(10, $creditCard->closing_day);
        $this->assertEquals(20, $creditCard->due_day);
        $this->assertEquals(1000, $creditCard->limit);
        $this->assertEquals($user->id, $creditCard->user_id);
        $this->assertEquals($bank->id, $creditCard->bank_id);
        $this->assertEquals(true, $creditCard->direct_debit);
    }

    public function testCreditCardCastedAttributes()
    {
        $creditCard = CreditCard::factory()->create();

        $this->assertIsString($creditCard->name);
        $this->assertIsString($creditCard->description);
        $this->assertIsInt($creditCard->closing_day);
        $this->assertIsInt($creditCard->due_day);
        $this->assertIsFloat($creditCard->limit);
        $this->assertIsString($creditCard->user_id);
        $this->assertIsString($creditCard->bank_id);
        $this->assertIsBool($creditCard->direct_debit);
    }
}
