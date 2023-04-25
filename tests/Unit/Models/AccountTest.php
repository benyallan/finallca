<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Enums\Account\AccountType;
use App\Models\Account;
use App\Models\Bank;
use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    public function testAccountHasCorrectAttributes(): void
    {
        $person = Person::factory()->create();
        $user = User::factory()->create();

        $account = Account::factory()
            ->forUser($user)
            ->forPerson($person)
            ->create([
                'id' => '1',
                'opening_balance' => '100',
                'description' => 'Conta do John',
                'type' => AccountType::CURRENT_ACCOUNT,
                'account_limit' => '1000',
            ]);

        $this->assertEquals('100.00', $account->opening_balance);
        $this->assertEquals('100.00', $account->balance);
        $this->assertEquals('1000.00', $account->account_limit);
        $this->assertEquals('Conta do John', $account->description);
        $this->assertEquals(AccountType::CURRENT_ACCOUNT, $account->type);
        $this->assertEquals($person->id, $account->person_id);
        $this->assertEquals($user->id, $account->user_id);
        $this->assertInstanceOf(User::class, $account->user);
        $this->assertInstanceOf(Bank::class, $account->bank);
        $this->assertInstanceOf(Person::class, $account->person);
        $this->assertInstanceOf(MorphMany::class, $account->transactions());
        $this->assertEquals($account->bank->name.' - '.$account->type->value, $account->label());
    }

    public function testAccountCastedAttributes(): void
    {
        $account = Account::factory()->create();

        $this->assertInstanceOf(AccountType::class, $account->type);
    }
}
