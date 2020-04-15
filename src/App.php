<?php
declare(strict_types = 1);

namespace VirtualBank;
use VirtualBank\Service\Atm;

class App {
    function run() {
        try {
            // create bank
            $bank = new Bank;

            // create accounts
            $john = new Account(400);
            $john->setName("John Doe");
            $john->setIban("GB18BARC20032618179759");
            echo "John has: " . (string)$john->getBalance() . "\n";

            $smith = new Account(300);
            $smith->setName("Alain Smith");
            $smith->setIban("GB40BARC20040125381552");
            echo "Smith has: " . (string)$smith->getBalance() . "\n";
            echo "---------------------------------------------------\n";

            // transfer 200
            $bank->transfer($john, $smith, 200);
            echo "Transfer 200 from John to Smith: \n";
            echo "John has now: " . (string)$john->getBalance() . "\n";
            echo "Smith has now: " . (string)$smith->getBalance() . "\n";
            echo "---------------------------------------------------\n";

            // smith withdraws 400
            $bank->withdraw($smith, 400);
            echo "Smith withdraws 400: \n";
            echo "John has now: " . (string)$john->getBalance() . "\n";
            echo "Smith has now: " . (string)$smith->getBalance() . "\n";

        } catch (Exception $e) {
            echo "Exception: " . $e->getMessage();
        }
    }
}