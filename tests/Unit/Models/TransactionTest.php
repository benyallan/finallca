<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Enums\Transaction\Direction;
use App\Models\CreditCard;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class TransactionTest extends TestCase
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
        $this->actingAs($user);

        $creditCardTransaction = Transaction::factory()->create([
            'user_id' => $user->id,
            'description' => 'Cartão de crédito do John',
            'transaction_amount' => '100.00',
            'due_date' => '2021-03-26',
            'completed_at' => '2021-03-26',
            'direction' => Direction::OUT,
        ]);

        $creditCardTransaction->accountable()->associate($creditCard);
        $creditCardTransaction->save();

        $this->assertInstanceOf(CreditCard::class, $creditCardTransaction->accountable);
    }

    public function testCreditCardTransactionCastedAttributes()
    {
        $this->actingAs(User::factory()->create());
        $accountTransaction = Transaction::factory()->create();

        $this->assertInstanceOf(User::class, $accountTransaction->user);
    }
}
