<?php

declare(strict_types=1);

namespace App\Enums\Transaction;

enum AccountTransactionType: string
{
    case PIX = 'pix';
    case TRANSFER_REGISTERED_ACCOUNT = 'Transferência para conta cadastrada';
    case TRANSFER_UNREGISTERED_ACCOUNT = 'Transferência para conta não cadastrada';
    case DEPOSIT = 'Depósito';
    case WITHDRAW = 'Saque';
    case FEE = 'Taxa';
    case INTEREST = 'Juros';
    case DIVIDEND = 'Dividendos';
    case REFUND = 'Estorno';
    case DEBIT = 'Débito';
    case PAYMENT = 'Pagamento';

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
            self::PIX => self::PIX,
            self::TRANSFER_REGISTERED_ACCOUNT => self::TRANSFER_REGISTERED_ACCOUNT,
            self::TRANSFER_UNREGISTERED_ACCOUNT => self::TRANSFER_UNREGISTERED_ACCOUNT,
            self::DEPOSIT => self::DEPOSIT,
            self::WITHDRAW => self::WITHDRAW,
            self::FEE => self::FEE,
            self::INTEREST => self::INTEREST,
            self::DIVIDEND => self::DIVIDEND,
            self::REFUND => self::REFUND,
            self::DEBIT => self::DEBIT,
            self::PAYMENT => self::PAYMENT,
            default => throw new \InvalidArgumentException('Invalid value'),
        };
    }

    public static function toFilamentSelectOptions()
    {
        return array_combine(self::getValues(), self::getValues());
    }
}
