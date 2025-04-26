<?php

declare(strict_types=1);

namespace VirtualBank\Entities;

use VirtualBank\Interfaces\Accountable;
use VirtualBank\Services\TransactionService;

readonly class Bank
{
    public function __construct(
        public TransactionService $transactionService
    ) {
    }

    public function transferMoney(Accountable $from, Accountable $to, float $amount): void
    {
        $this->transactionService->transfer($from, $to, $amount);
    }

    public function withdrawMoney(Accountable $account, float $amount): void
    {
        $this->transactionService->withdraw($account, $amount);
    }

    public function depositMoney(Accountable $account, float $amount): void
    {
        $this->transactionService->deposit($account, $amount);
    }
}
