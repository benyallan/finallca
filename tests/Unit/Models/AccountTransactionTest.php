<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Enums\Transaction\AccountTransactionStatus;
use App\Enums\Transaction\AccountTransactionType;
use App\Enums\Transaction\TransactionDirection;
use App\Models\Account;
use App\Models\AccountTransaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class AccountTransactionTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate:fresh --seed');
    }

    public function testAccountTransactionHasCorrectAttributes()
    {
        $account = Account::factory()->create();
        $user = User::factory()->create();

        $accountTransaction = AccountTransaction::factory()->create([
            'account_id' => $account->id,
            'user_id' => $user->id,
            'description' => 'Conta do John',
            'value' => '100',
            'type' => AccountTransactionType::WITHDRAW,
            'date' => '2021-03-26',
            'direction' => TransactionDirection::OUT,
            'status' => AccountTransactionStatus::PAID,
        ]);

        $this->assertEquals($account->id, $accountTransaction->account_id);
        $this->assertEquals($user->id, $accountTransaction->user_id);
        $this->assertEquals('Conta do John', $accountTransaction->description);
        $this->assertEquals('100.00', $accountTransaction->value);
        $this->assertEquals(AccountTransactionType::WITHDRAW, $accountTransaction->type);
        $this->assertEquals(Carbon::createFromDate('2021-03-26'), $accountTransaction->date);
        $this->assertEquals(TransactionDirection::OUT, $accountTransaction->direction);
        $this->assertEquals(AccountTransactionStatus::PAID, $accountTransaction->status);
    }

    public function testAccountTransactionCastedAttributes()
    {
        $accountTransaction = AccountTransaction::factory()->create();

        $this->assertInstanceOf(User::class, $accountTransaction->user);
    }
}
