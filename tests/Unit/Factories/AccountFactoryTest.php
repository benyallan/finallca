<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanCreateAnAccountWithDefaultAttributes()
    {
        $account = \App\Models\Account::factory()->create();

        $this->assertNotNull($account);
        $this->assertNotEmpty($account->description);
        $this->assertNotEmpty($account->opening_balance);
        $this->assertNotEmpty($account->balance);
        $this->assertNotEmpty($account->type);
        $this->assertNotEmpty($account->user_id);
        $this->assertNotEmpty($account->bank_id);
        $this->assertNotEmpty($account->number);
        $this->assertNotEmpty($account->limit);
        $this->assertNotEmpty($account->income);
        $this->assertNotEmpty($account->maintenance_fee);
    }

    public function testItCanCreateAnAccountWithGivenType()
    {
        $account = \App\Models\User::factory()
            ->ofType(App\Enums\AccountType::CURRENT_ACCOUNT)
            ->create();

        $this->assertNotNull($account);
        $this->assertNotEmpty($account->description);
        $this->assertNotEmpty($account->opening_balance);
        $this->assertNotEmpty($account->balance);
        $this->assertNotEmpty($account->type);
        $this->assertNotEmpty($account->user_id);
        $this->assertNotEmpty($account->bank_id);
        $this->assertNotEmpty($account->number);
        $this->assertNotEmpty($account->limit);
        $this->assertNotEmpty($account->income);
        $this->assertNotEmpty($account->maintenance_fee);
    }
}
