<?php

declare(strict_types=1);

namespace Tests\Entities;

use PHPUnit\Framework\TestCase;
use VirtualBank\Entities\Account;
use VirtualBank\Entities\Bank;
use VirtualBank\Exceptions\InsufficientFundsException;
use VirtualBank\Exceptions\InvalidDepositException;
use VirtualBank\Exceptions\InvalidWithdrawException;
use VirtualBank\Exceptions\InvalidTransferException;
use VirtualBank\Services\TransactionService;

class BankTest extends TestCase
{
    private Bank $bank;

    protected function setUp(): void
    {
        parent::setUp();
        $transactionService = new TransactionService();
        $this->bank = new Bank($transactionService);
    }

    public function testTransferMoney(): void
    {
        $fromAccount = new Account('Joe', '123456789', 1000.0);
        $toAccount = new Account('Sam', '987654321', 500.0);

        $this->bank->transferMoney($fromAccount, $toAccount, 200.0);

        $this->assertEquals(800.0, $fromAccount->getBalance());
        $this->assertEquals(700.0, $toAccount->getBalance());
    }

    public function testWithdrawMoney(): void
    {
        $account = new Account('Joe', '123456789', 1000.0);

        $this->bank->withdrawMoney($account, 200.0);

        $this->assertEquals(800.0, $account->getBalance());
    }

    public function testDepositMoney(): void
    {
        $account = new Account('Joe', '123456789', 1000.0);

        $this->bank->depositMoney($account, 200.0);

        $this->assertEquals(1200.0, $account->getBalance());
    }

    public function testTransferMoneyWithSameIban(): void
    {
        $fromAccount = new Account('Joe', '123456789', 1000.0);
        $toAccount = new Account('Joe', '123456789', 500.0);

        $this->expectException(InvalidTransferException::class);
        $this->expectExceptionMessage('Cannot transfer to the same IBAN.');

        $this->bank->transferMoney($fromAccount, $toAccount, 200.0);
    }

    public function testTransferMoneyWithNegativeAmount(): void
    {
        $fromAccount = new Account('Joe', '123456789', 1000.0);
        $toAccount = new Account('Sam', '987654321', 500.0);

        $this->expectException(InvalidTransferException::class);
        $this->expectExceptionMessage('Transfer amount must be positive.');

        $this->bank->transferMoney($fromAccount, $toAccount, -200.0);
    }

    public function testWithdrawMoneyWithInsufficientFunds(): void
    {
        $account = new Account('Joe', '123456789', 100.0);

        $this->expectException(InsufficientFundsException::class);
        $this->expectExceptionMessage('Not enough funds.');

        $this->bank->withdrawMoney($account, 200.0);
    }

    public function testDepositMoneyWithInvalidAmount(): void
    {
        $account = new Account('Joe', '123456789', 1000.0);

        $this->expectException(InvalidDepositException::class);
        $this->expectExceptionMessage('Deposit amount must be greater than zero.');

        $this->bank->depositMoney($account, -200.0);
    }
}