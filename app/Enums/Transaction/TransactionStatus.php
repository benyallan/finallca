<?php

declare(strict_types=1);

namespace App\Enums\Transaction;

enum TransactionStatus: string
{
    case PENDING = 'pending';
    case PAID = 'paid';

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
            self::PENDING => self::PENDING,
            self::PAID => self::PAID,
            default => throw new \InvalidArgumentException('Invalid value'),
        };
    }

    public static function toFilamentSelectOptions()
    {
        return array_combine(self::getValues(), self::getValues());
    }
}
