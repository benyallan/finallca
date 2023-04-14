<?php

declare(strict_types=1);

use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanCreateAnAccountWithDefaultAttributes()
    {
        $account = \App\Models\Account::factory()->create();

        $this->verifyAsserts($account);
    }

    public function testItCanCreateAnAccountWithGivenType()
    {
        $type = App\Enums\Account\AccountType::CURRENT_ACCOUNT;
        $account = \App\Models\Account::factory()
            ->ofType($type)
            ->create();

        $this->verifyAsserts($account, ['type' => $type]);
    }

    public function testItCanCreateAnAccountWithGivenBank()
    {
        $bank = \App\Models\Bank::factory()->create();

        $account = \App\Models\Account::factory()
            ->forBank($bank)
            ->create();

        $this->verifyAsserts($account, ['bank' => $bank]);
    }

    public function testItCanCreateAnAccountWithGivenPerson()
    {
        $person = \App\Models\Person::factory()->create();

        $account = \App\Models\Account::factory()
            ->forPerson($person)
            ->create();

        $this->verifyAsserts($account, ['person' => $person]);
    }

    public function testItCanCreateAnAccountWithGivenUser()
    {
        $user = \App\Models\User::factory()->create();

        $account = \App\Models\Account::factory()
            ->forUser($user)
            ->create();

        $this->verifyAsserts($account, ['user' => $user]);
    }

    private function verifyAsserts(Account $account, array $data = []): void
    {
        $this->assertNotNull($account);
        $this->assertNotEmpty($account->description);
        $this->assertNotEmpty($account->opening_balance);
        $this->assertNotEmpty($account->balance);
        $this->assertNotEmpty($account->type);
        $this->assertNotEmpty($account->user_id);
        $this->assertNotEmpty($account->bank_id);
        $this->assertNotEmpty($account->account_limit);
        $this->assertInstanceOf(\App\Enums\Account\AccountType::class, $account->type);
        $this->assertInstanceOf(\App\Models\User::class, $account->user);
        $this->assertInstanceOf(\App\Models\Bank::class, $account->bank);
        $this->assertInstanceOf(\App\Models\Person::class, $account->person);

        if (isset($data['type'])) {
            $this->assertEquals($data['type'], $account->type);
        }

        if (isset($data['user'])) {
            $this->assertEquals($data['user']->id, $account->user_id);
        }

        if (isset($data['bank'])) {
            $this->assertEquals($data['bank']->id, $account->bank_id);
        }

        if (isset($data['person'])) {
            $this->assertEquals($data['person']->id, $account->person_id);
        }
    }
}
