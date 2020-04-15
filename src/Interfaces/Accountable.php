<?php
declare(strict_types = 1);

namespace VirtualBank\Interfaces;

interface Accountable {
    public function getName() : string;
    public function setName(string $name) : void;
    public function getIban() : string;
    public function setIban(string $iban) : void;
    public function getBalance() : float;
}