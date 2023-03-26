<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Enums\Transaction\CreditCardTransactionType;
use App\Enums\Transaction\TransactionDirection;
use App\Enums\Transaction\TransactionStatus;
use App\Models\AccountTransaction;
use App\Models\CreditCard;
use App\Models\CreditCardTransaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CreditCardTransactionTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate:fresh --seed');
    }

    public function testCreditCardTransactionHasCorrectAttributes()
    {
        $user = User::factory()->create();
        $creditCard = CreditCard::factory()->forUser($user)->create();

        $creditCardTransaction = CreditCardTransaction::factory()->create([
            'user_id' => $user->id,
            'credit_card_id' => $creditCard->id,
            'description' => 'Cartão de crédito do John',
            'value' => '100.00',
            'type' => CreditCardTransactionType::WITHDRAW,
            'date' => '2021-03-26',
            'direction' => TransactionDirection::OUT,
            'status' => TransactionStatus::PAID,
        ]);

        $this->assertEquals($user->id, $creditCardTransaction->user_id);
        $this->assertEquals($creditCard->id, $creditCardTransaction->credit_card_id);
        $this->assertEquals('Cartão de crédito do John', $creditCardTransaction->description);
        $this->assertEquals('100.00', $creditCardTransaction->value);
        $this->assertEquals(CreditCardTransactionType::WITHDRAW, $creditCardTransaction->type);
        $this->assertEquals(Carbon::createFromDate('2021-03-26'), $creditCardTransaction->date);
        $this->assertEquals(TransactionDirection::OUT, $creditCardTransaction->direction);
        $this->assertEquals(TransactionStatus::PAID, $creditCardTransaction->status);
    }

    public function testCreditCardTransactionCastedAttributes()
    {
        $accountTransaction = AccountTransaction::factory()->create();

        $this->assertInstanceOf(User::class, $accountTransaction->user);
    }
}
