<?php
declare(strict_types = 1);

namespace VirtualBank;
use VirtualBank\Interfaces\Accountable;

class Bank {
    public function transfer(Accountable $firstAccount, Accountable $secondAccount, float $amount) : void
    {
        $firstAccount->withdraw($amount);
        $secondAccount->deposit($amount);
    }

    public function withdraw(Accountable $account, float $amount) : void
    {
        $account->withdraw($amount);
    }

    public function deposit(Accountable $account, float $amount) : void
    {
        $account->deposit($amount);   
    }
}