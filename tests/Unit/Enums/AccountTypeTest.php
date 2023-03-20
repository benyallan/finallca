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

        $this->assertEquals($expected, AccountType::values());
    }
}

