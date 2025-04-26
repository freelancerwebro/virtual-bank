<?php

declare(strict_types=1);

namespace VirtualBank\Entities;

use VirtualBank\Exceptions\InvalidDepositException;
use VirtualBank\Exceptions\InvalidWithdrawException;
use VirtualBank\Interfaces\Accountable;
use VirtualBank\Interfaces\Cashable;
use VirtualBank\Exceptions\InsufficientFundsException;
use VirtualBank\Exceptions\InvalidTransferException;

class Account implements Accountable, Cashable
{
    /**
     * @throws InvalidTransferException
     */
    public function __construct(
        private readonly string $name,
        private readonly string $iban,
        private float $balance = 0
    ) {
        if ($balance < 0) {
            throw new InvalidTransferException('Initial balance cannot be negative.');
        }
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIban(): string
    {
        return $this->iban;
    }

    /**
     * @throws InvalidDepositException
     */
    public function deposit(float $amount): void
    {
        if ($amount <= 0) {
            throw new InvalidDepositException('Deposit amount must be greater than zero.');
        }
        $this->balance += $amount;
    }

    /**
     * @throws InsufficientFundsException
     * @throws InvalidWithdrawException
     */
    public function withdraw(float $amount): void
    {
        if ($amount > $this->balance) {
            throw new InsufficientFundsException('Not enough funds.');
        }
        if ($amount <= 0) {
            throw new InvalidWithdrawException('Deposit amount must be greater than zero.');
        }

        $this->balance -= $amount;
    }
}
