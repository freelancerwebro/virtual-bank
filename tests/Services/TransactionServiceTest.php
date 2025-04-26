<?php

declare(strict_types=1);

namespace Tests\Services;

use PHPUnit\Framework\TestCase;
use VirtualBank\Entities\Account;
use VirtualBank\Exceptions\InsufficientFundsException;
use VirtualBank\Exceptions\InvalidDepositException;
use VirtualBank\Exceptions\InvalidTransferException;
use VirtualBank\Services\TransactionService;

class TransactionServiceTest extends TestCase
{
    private TransactionService $transactionService;
    private Account $fromAccount;
    private Account $toAccount;

    public function setUp(): void
    {
        parent::setUp();

        $this->fromAccount = new Account('John Doe', 'GB18BARC20032618179759', 100.0);
        $this->toAccount = new Account('Alain Smith', 'GB40BARC20040125381552', 50.0);
        $this->transactionService = new TransactionService();
    }

    public function testTransfer(): void
    {
        $this->transactionService->transfer($this->fromAccount, $this->toAccount, 25.0);

        $this->assertEquals(75.0, $this->fromAccount->getBalance());
        $this->assertEquals(75.0, $this->toAccount->getBalance());
    }

    public function testWithdraw(): void
    {
        $this->transactionService->withdraw($this->fromAccount, 90.0);

        $this->assertEquals(10.0, $this->fromAccount->getBalance());
    }

    public function testDeposit(): void
    {
        $this->transactionService->deposit($this->fromAccount, 50.0);

        $this->assertEquals(150.0, $this->fromAccount->getBalance());
    }

    public function testTransferWithNegativeAmount(): void
    {
        $this->expectException(InvalidTransferException::class);
        $this->expectExceptionMessage('Transfer amount must be positive.');
        $this->transactionService->transfer($this->fromAccount, $this->toAccount, -10.0);
    }

    public function testTransferToSameIban(): void
    {
        $this->expectException(InvalidTransferException::class);
        $this->expectExceptionMessage('Cannot transfer to the same IBAN.');
        $this->transactionService->transfer($this->fromAccount, $this->fromAccount, 10.0);
    }

    public function testWithdrawInsufficientFunds(): void
    {
        $this->expectException(InsufficientFundsException::class);
        $this->expectExceptionMessage('Not enough funds.');
        $this->transactionService->withdraw($this->fromAccount, 200.0);
    }

    public function testDepositInvalidAmount(): void
    {
        $this->expectException(InvalidDepositException::class);
        $this->expectExceptionMessage('Deposit amount must be greater than zero.');
        $this->transactionService->deposit($this->fromAccount, -50.0);
    }

    public function testDepositZeroAmount(): void
    {
        $this->expectException(InvalidDepositException::class);
        $this->expectExceptionMessage('Deposit amount must be greater than zero.');
        $this->transactionService->deposit($this->fromAccount, 0.0);
    }

    public function testTransferWithZeroAmount(): void
    {
        $this->expectException(InvalidTransferException::class);
        $this->expectExceptionMessage('Transfer amount must be positive.');
        $this->transactionService->transfer($this->fromAccount, $this->toAccount, 0.0);
    }
}