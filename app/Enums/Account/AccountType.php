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

    public static function getValues(): array
    {
        return array_values(array_values(self::toArray()));
    }

    public static function fromValue(string $value): self
    {
        return match ($value) {
            self::CURRENT_ACCOUNT->value => self::CURRENT_ACCOUNT,
            self::SAVING_ACCOUNT->value => self::SAVING_ACCOUNT,
            self::SALARY_ACCOUNT->value => self::SALARY_ACCOUNT,
            self::INVESTMENT_ACCOUNT->value => self::INVESTMENT_ACCOUNT,
            default => throw new \InvalidArgumentException('Invalid value'),
        };
    }

    public static function toFilamentSelectOptions()
    {
        return array_combine(self::getValues(), self::getValues());
    }
}
