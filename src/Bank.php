<?php
declare(strict_types = 1);

namespace VirtualBank;
use VirtualBank\Interfaces\Cashable;
use VirtualBank\Interfaces\Accountable;
use VirtualBank\Interfaces\Transferable;

class Bank implements Cashable, Transferable {
    private $firstAccount;
    private $secondAccount;

    public function setFirstAccount(Accountable $account) : void
    {
        $this->firstAccount = $account;
    }

    public function setSecondAccount(Accountable $account) : void
    {
        $this->secondAccount = $account;
    }

    public function transfer(float $amount) : void
    {
        $this->firstAccount->withdraw($amount);
        $this->secondAccount->deposit($amount);
    }

    public function withdraw(float $amount) : void
    {
        $this->firstAccount->withdraw($amount);
    }

    public function deposit(float $amount) : void
    {
        $this->firstAccount->deposit($amount);
    }
}