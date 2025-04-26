<?php

declare(strict_types=1);

namespace VirtualBank\Interfaces;

interface BankInterface
{
    public function transfer(Accountable $from, Accountable $to, float $amount): void;
    public function withdraw(Accountable $account, float $amount): void;
    public function deposit(Accountable $account, float $amount): void;
}