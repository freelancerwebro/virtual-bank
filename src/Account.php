<?php
declare(strict_types = 1);

namespace VirtualBank;
use VirtualBank\Interfaces\Cashable;
use VirtualBank\Interfaces\Accountable;

class Account implements Cashable, Accountable {
    private $balance;
    private $iban;
    private $name;

    public function __construct(float $initialBalance)
    {
        $this->deposit($initialBalance);
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    public function getIban() : string
    {
        return $this->iban;
    }

    public function setIban(string $iban) : void
    {
        $this->iban = $iban;
    }

    public function getBalance() : float
    {
        return $this->balance;
    }
    
    public function deposit(float $amount) : void
    {
        if ($amount <= 0) {
            throw new \Exception("You tried to deposit an invalid amount of money.", 1);
        }
        $this->balance = $this->balance + $amount;
    }

    public function withdraw(float $amount) : void
    {
        if ($amount > $this->balance) {
            throw new \Exception("Your balance does not have enough money.", 1);
        }
        $this->balance = $this->balance - $amount;
    }
}