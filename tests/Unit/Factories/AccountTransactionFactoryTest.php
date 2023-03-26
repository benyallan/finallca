<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountTransactionFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanCreateAnAccountWithDefaultAttributes()
    {
        $accountTransaction = \App\Models\AccountTransaction::factory()->create();

        $this->assertNotNull($accountTransaction);
        $this->assertNotEmpty($accountTransaction->description);
        $this->assertNotEmpty($accountTransaction->value);
        $this->assertNotEmpty($accountTransaction->type);
        $this->assertNotEmpty($accountTransaction->date);
        $this->assertNotEmpty($accountTransaction->direction);
        $this->assertNotEmpty($accountTransaction->status);
        $this->assertNotEmpty($accountTransaction->user_id);
        $this->assertNotEmpty($accountTransaction->account_id);
        $this->assertInstanceOf(\App\Enums\Account\AccountTransactionType::class, $accountTransaction->type);
        $this->assertInstanceOf(\App\Enums\Account\AccountTransactionDirection::class, $accountTransaction->direction);
        $this->assertInstanceOf(\App\Enums\Account\AccountTransactionStatus::class, $accountTransaction->status);
        $this->assertInstanceOf(\App\Models\User::class, $accountTransaction->user);
        $this->assertInstanceOf(\App\Models\Account::class, $accountTransaction->account);
    }
}
