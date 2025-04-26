<?php

declare(strict_types=1);

namespace VirtualBank\Services;

use VirtualBank\Exceptions\InvalidTransferException;
use VirtualBank\Interfaces\Accountable;
use VirtualBank\Interfaces\BankInterface;

class TransactionService implements BankInterface
{
    /**
     * @throws InvalidTransferException
     */
    public function transfer(Accountable $from, Accountable $to, float $amount): void
    {
        if ($amount <= 0) {
            throw new InvalidTransferException('Transfer amount must be positive.');
        }

        if ($from->getIban() === $to->getIban()) {
            throw new InvalidTransferException('Cannot transfer to the same IBAN.');
        }

        $from->withdraw($amount);
        $to->deposit($amount);
    }

    public function withdraw(Accountable $account, float $amount): void
    {
        $account->withdraw($amount);
    }

    public function deposit(Accountable $account, float $amount): void
    {
        $account->deposit($amount);
    }
}
