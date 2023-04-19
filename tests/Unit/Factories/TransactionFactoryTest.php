<?php

declare(strict_types=1);

namespace Tests\Unit\Factories;

use App\Enums\Transaction\Direction;
use App\Models\Account;
use App\Models\CreditCard;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function testDefinition(): void
    {
        $transaction = Transaction::factory()->create();

        $this->verifyAsserts($transaction);
    }

    public function testCredit(): void
    {
        $transaction = Transaction::factory()->credit()->create();

        $this->verifyAsserts($transaction, ['direction' => Direction::IN]);
    }

    public function testDebit(): void
    {
        $transaction = Transaction::factory()->debit()->create();

        $this->verifyAsserts($transaction, ['direction' => Direction::OUT]);
    }

    public function testForUser(): void
    {
        $user = User::factory()->create();

        $transaction = Transaction::factory()->forUser($user)->create();

        $this->verifyAsserts($transaction, ['user' => $user]);
    }

    public function testForAccount(): void
    {
        $account = Account::factory()->create();

        $transaction = Transaction::factory()->forAccount($account)->make();

        $this->verifyAsserts($transaction, ['account' => $account]);
    }

    public function testForCreditCard(): void
    {
        $creditCard = CreditCard::factory()->create();

        $transaction = Transaction::factory()->forCreditCard($creditCard)->create();

        $this->verifyAsserts($transaction, ['credit_card' => $creditCard]);
    }

    private function verifyAsserts(Transaction $transaction, array $data = []): void
    {
        $this->assertNotNull($transaction);
        $this->assertNotEmpty($transaction->description);
        $this->assertNotEmpty($transaction->transaction_amount);
        $this->assertNotEmpty($transaction->due_date);
        $this->assertNotEmpty($transaction->completed_at);
        $this->assertNotEmpty($transaction->direction);
        $this->assertTrue(Str::isUuid($transaction['user_id']));
        $this->assertTrue(Str::isUuid($transaction['accountable_id']));
        $this->assertInstanceOf(\App\Models\User::class, $transaction->user);
        $this->assertInstanceOf(\App\Enums\Transaction\Direction::class, $transaction->direction);
        $this->assertContains($transaction->accountable_type, [CreditCard::class, Account::class]);

        if (isset($data['user'])) {
            $this->assertEquals($transaction->user_id, $data['user']->id);
        }

        if (isset($data['account'])) {
            $this->assertEquals($transaction->accountable_id, $data['account']->id);
        }

        if (isset($data['credit_card'])) {
            $this->assertEquals($transaction->accountable_id, $data['credit_card']->id);
        }

        if (isset($data['direction'])) {
            $this->assertEquals($transaction->direction, $data['direction']);
        }
    }
}
