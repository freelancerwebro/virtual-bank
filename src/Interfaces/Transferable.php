<?php
declare(strict_types = 1);

namespace VirtualBank\Interfaces;

interface Transferable {
    public function transfer(float $amount) : void;
}