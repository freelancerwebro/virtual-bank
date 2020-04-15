<?php
declare(strict_types = 1);

namespace VirtualBank\Interfaces;

interface Cashable {
    public function deposit(float $amount) : void;
    public function withdraw(float $amount) : void;
}
