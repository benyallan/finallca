<?php

declare(strict_types=1);

namespace App\Enums\Account;

enum AccountType: string
{
    case CURRENT_ACCOUNT = 'Conta Corrente';
    case SAVING_ACCOUNT = 'Conta Poupança';
    case SALARY_ACCOUNT = 'Conta Salário';
    case INVESTMENT_ACCOUNT = 'Conta Investimento';

    public static function toArray(): array
    {
        $reflectionClass = new \ReflectionClass(self::class);
        $constants = $reflectionClass->getConstants();

        $result = [];

        foreach ($constants as $name => $value) {
            $result[$name] = $value->value;
        }

        return $result;
    }

    public static function values(): array
    {
        return array_values(array_values(self::toArray()));
    }
}
