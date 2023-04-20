<?php

declare(strict_types=1);

namespace Tests\Unit\Enums;

use App\Enums\Account\AccountType;
use App\Enums\Transaction\AccountableType;
use Tests\TestCase;

class AccountableTypeTest extends TestCase
{
    public function testAccountableTypeHasExpectedValues()
    {
        $this->assertEquals('Conta Bancária', AccountableType::ACCOUNT->value);
        $this->assertEquals('Cartão de Crédito', AccountableType::CREDIT_CARD->value);
    }

    public function testAccountableTypeToArray()
    {
        $expected = [
            'ACCOUNT' => 'Conta Bancária',
            'CREDIT_CARD' => 'Cartão de Crédito',
        ];

        $this->assertEquals($expected, AccountableType::toArray());
    }

    public function testAccountableTypeValues()
    {
        $expected = [
            'Conta Bancária',
            'Cartão de Crédito',
        ];

        $this->assertEquals($expected, AccountableType::getValues());
    }

    public function testAccountableTypeFromValue()
    {
        $this->assertEquals(AccountableType::ACCOUNT, AccountableType::fromValue('Conta Bancária'));
        $this->assertEquals(AccountableType::CREDIT_CARD, AccountableType::fromValue('Cartão de Crédito'));
    }

    public function testAccountableTypeToFilamentSelectOptions()
    {
        $expected = [
            'Conta Bancária' => 'Conta Bancária',
            'Cartão de Crédito' => 'Cartão de Crédito',
        ];

        $this->assertEquals($expected, AccountableType::toFilamentSelectOptions());
    }

    public function testAccountableTypeGetOptionClasses()
    {
        $expected = [
            'App\Models\Account' => 'Conta Bancária',
            'App\Models\CreditCard' => 'Cartão de Crédito',
        ];

        $this->assertEquals($expected, AccountableType::getOptionClasses());
    }
}
