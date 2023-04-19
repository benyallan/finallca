<?php

declare(strict_types=1);

namespace App\Enums\Transaction;

use App\Models\Account;

enum AccountableType: string
{
    case ACCOUNT = 'Conta Bancária';
    case CREDIT_CARD = 'Cartão de Crédito';

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
            self::ACCOUNT->value => self::ACCOUNT,
            self::CREDIT_CARD->value => self::CREDIT_CARD,
            default => throw new \InvalidArgumentException('Invalid value'),
        };
    }

    public static function toFilamentSelectOptions()
    {
        return array_combine(self::getValues(), self::getValues());
    }

    public static function getOptionClasses(): array
    {
        $classes = [
            self::ACCOUNT->value => Account::class,
            self::CREDIT_CARD->value => CreditCard::class,
        ];
        return array_combine($classes, self::getValues());
    }

    public static function getOptionClass(string $value): string
    {
        return match ($value) {
            self::ACCOUNT->value => Account::class,
            self::CREDIT_CARD->value => CreditCard::class,
            default => throw new \InvalidArgumentException('Invalid value'),
        };
    }
}
