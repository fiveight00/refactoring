<?php

declare(strict_types=1);

namespace App\Domain\Transaction\Service;

use App\Domain\Transaction\Model\TransactionModel;

class TransactionService
{
    public function __construct(
        private readonly TransactionProvider $transactionProvider,
    ) {
    }

    /**
     * @return TransactionModel[]
     */
    public function getTransactionsFromInput(): array
    {
        return $this->transactionProvider->getTransactionsFromInput();
    }
}