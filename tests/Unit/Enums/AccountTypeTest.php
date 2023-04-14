<?php

declare(strict_types=1);

namespace Tests\Unit\Enums;

use App\Enums\Account\AccountType;
use Tests\TestCase;

class AccountTypeTest extends TestCase
{
    public function testAccountTypeHasExpectedValues()
    {
        $this->assertEquals('Conta Corrente', AccountType::CURRENT_ACCOUNT->value);
        $this->assertEquals('Conta Poupança', AccountType::SAVING_ACCOUNT->value);
        $this->assertEquals('Conta Salário', AccountType::SALARY_ACCOUNT->value);
        $this->assertEquals('Conta Investimento', AccountType::INVESTMENT_ACCOUNT->value);
    }

    public function testAccountTypeToArray()
    {
        $expected = [
            'CURRENT_ACCOUNT' => 'Conta Corrente',
            'SAVING_ACCOUNT' => 'Conta Poupança',
            'SALARY_ACCOUNT' => 'Conta Salário',
            'INVESTMENT_ACCOUNT' => 'Conta Investimento',
        ];

        $this->assertEquals($expected, AccountType::toArray());
    }

    public function testAccountTypeValues()
    {
        $expected = [
            'Conta Corrente',
            'Conta Poupança',
            'Conta Salário',
            'Conta Investimento',
        ];

        $this->assertEquals($expected, AccountType::getValues());
    }

    public function testAccountTypeFromValue()
    {
        $this->assertEquals(AccountType::CURRENT_ACCOUNT, AccountType::fromValue('Conta Corrente'));
        $this->assertEquals(AccountType::SAVING_ACCOUNT, AccountType::fromValue('Conta Poupança'));
        $this->assertEquals(AccountType::SALARY_ACCOUNT, AccountType::fromValue('Conta Salário'));
        $this->assertEquals(AccountType::INVESTMENT_ACCOUNT, AccountType::fromValue('Conta Investimento'));
    }

    public function testAccountTypeToFilamentSelectOptions()
    {
        $expected = [
            'Conta Corrente' => 'Conta Corrente',
            'Conta Poupança' => 'Conta Poupança',
            'Conta Salário' => 'Conta Salário',
            'Conta Investimento' => 'Conta Investimento',
        ];

        $this->assertEquals($expected, AccountType::toFilamentSelectOptions());
    }
}
