<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Enums\Account\AccountType;
use App\Models\Account;
use App\Models\Person;
use App\Models\User;
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
        $person = Person::factory()->create();
        $user = User::factory()->create();

        $account = Account::factory()->create([
            'opening_balance' => '100',
            'description' => 'Conta do John',
            'type' => AccountType::CURRENT_ACCOUNT,
            'person_id' => $person->id,
            'user_id' => $user->id,
        ]);

        $this->assertEquals('100', $account->opening_balance);
        $this->assertEquals('Conta do John', $account->description);
        $this->assertEquals(AccountType::CURRENT_ACCOUNT, $account->type);
        $this->assertEquals($person->id, $account->person_id);
        $this->assertEquals($user->id, $account->user_id);
    }

    public function testAccountCastedAttributes()
    {
        $account = Account::factory()->create();

        $this->assertInstanceOf(AccountType::class, $account->type);
    }
}
