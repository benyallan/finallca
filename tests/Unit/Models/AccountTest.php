<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Enums\Account\AccountType;
use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate:fresh --seed');
    }

    public function testAccountHasCorrectAttributes()
    {
        $account = Account::factory()->create([
            'opening_balance' => '100',
            'description' => 'Conta do John',
            'type' => AccountType::CURRENT_ACCOUNT,
        ]);

        $this->assertEquals('100', $account->opening_balance);
        $this->assertEquals('Conta do John', $account->description);
        $this->assertEquals(AccountType::CURRENT_ACCOUNT, $account->type);
    }

    public function testAccountCastedAttributes()
    {
        $account = Account::factory()->create();

        $this->assertInstanceOf(AccountType::class, $account->type);
    }
}
