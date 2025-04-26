<?php
declare(strict_types = 1);

namespace VirtualBank\Interfaces;

interface Accountable {
    public function getName() : string;
    public function getIban() : string;
    public function getBalance() : float;
}