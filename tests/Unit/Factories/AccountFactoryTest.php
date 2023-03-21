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
        $this->assertIsBool($account->income);
        $this->assertNotEmpty($account->maintenance_fee);
        $this->assertInstanceOf(\App\Enums\Account\AccountType::class, $account->type);
        $this->assertInstanceOf(\App\Models\User::class, $account->user);
        $this->assertInstanceOf(\App\Models\Bank::class, $account->bank);
        $this->assertInstanceOf(\App\Models\Person::class, $account->person);
    }

    public function testItCanCreateAnAccountWithGivenType()
    {
        $account = \App\Models\Account::factory()
            ->ofType(App\Enums\Account\AccountType::CURRENT_ACCOUNT)
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
        $this->assertIsBool($account->income);
        $this->assertNotEmpty($account->maintenance_fee);
        $this->assertInstanceOf(\App\Enums\Account\AccountType::class, $account->type);
        $this->assertInstanceOf(\App\Models\User::class, $account->user);
        $this->assertInstanceOf(\App\Models\Bank::class, $account->bank);
        $this->assertInstanceOf(\App\Models\Person::class, $account->person);
    }
}
