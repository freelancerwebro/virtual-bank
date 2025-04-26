<?php

declare(strict_types=1);

namespace Tests\Entities;
use PHPUnit\Framework\TestCase;
use VirtualBank\Entities\Account;
use VirtualBank\Exceptions\InsufficientFundsException;
use VirtualBank\Exceptions\InvalidDepositException;
use VirtualBank\Exceptions\InvalidWithdrawException;

class AccountTest extends TestCase
{
    private Account $account;

    protected function setUp(): void
    {
        parent::setUp();
        $this->account = new Account('John Doe', 'GB18BARC20032618179759', 100.0);
    }

    public function testGetName(): void
    {
        $this->assertEquals('John Doe', $this->account->getName());
    }

    public function testGetIban(): void
    {
        $this->assertEquals('GB18BARC20032618179759', $this->account->getIban());
    }

    public function testGetBalance(): void
    {
        $this->assertEquals(100.0, $this->account->getBalance());
    }

    public function testDeposit(): void
    {
        $this->account->deposit(50.0);
        $this->assertEquals(150.0, $this->account->getBalance());
    }

    public function testDepositNegativeAmount(): void
    {
        $this->expectException(InvalidDepositException::class);
        $this->account->deposit(-50.0);
    }

    public function testDepositZeroAmount(): void
    {
        $this->expectException(InvalidDepositException::class);
        $this->account->deposit(0.0);
    }

    public function testWithdraw(): void
    {
        $this->account->withdraw(50.0);
        $this->assertEquals(50.0, $this->account->getBalance());
    }

    public function testWithdrawMoreThanBalance(): void
    {
        $this->expectException(InsufficientFundsException::class);
        $this->account->withdraw(150.0);
    }

    public function testWithdrawNegativeAmount(): void
    {
        $this->expectException(InvalidWithdrawException::class);
        $this->account->withdraw(-50.0);
    }

    public function testWithdrawZeroAmount(): void
    {
        $this->expectException(InvalidWithdrawException::class);
        $this->account->withdraw(0.0);
    }
}