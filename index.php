<?php

declare(strict_types=1);

use VirtualBank\Entities\Account;
use VirtualBank\Services\TransactionService;
use VirtualBank\Entities\Bank;

require 'vendor/autoload.php';

$john = new Account('John Doe', 'GB18BARC20032618179759', 500);
$smith = new Account('Alain Smith', 'GB40BARC20040125381552', 200);

echo "John's balance: {$john->getBalance()}\n";
echo "Smith's balance: {$smith->getBalance()}\n";
echo "-----------------------------------------\n";

$transactionService = new TransactionService();
$bank = new Bank($transactionService);

echo "Transferring 200 from John to Smith...\n";
$bank->transferMoney($john, $smith, 200);

echo "John's balance: {$john->getBalance()}\n";
echo "Smith's balance: {$smith->getBalance()}\n";
echo "-----------------------------------------\n";

echo "Smith withdraws 400...\n";
$bank->withdrawMoney($smith, 400);

echo "Smith's balance after withdrawal: {$smith->getBalance()}\n";
echo "-----------------------------------------\n";

echo "John deposits 500...\n";
$bank->depositMoney($john, 500);

echo "John's balance after deposit: {$john->getBalance()}\n";
echo "-----------------------------------------\n";