<?php

declare(strict_types=1);

namespace Unit\Domain\Transaction\Service;

use App\Domain\Transaction\Model\TransactionModel;
use App\Domain\Transaction\Service\TransactionProvider;
use App\Domain\Transaction\Service\TransactionService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TransactionServiceTest extends TestCase
{
    /** @var TransactionProvider&MockObject */
    private TransactionProvider $transactionProvider;

    public function setUp(): void
    {
        $this->transactionProvider = $this->createMock(TransactionProvider::class);
    }

    public function testGetTransactionsFromInput(): void
    {
        $this->transactionProvider->method('getTransactionsFromInput')
            ->willReturn([new TransactionModel('123', '10', 'USD')]);

        $result = (new TransactionService($this->transactionProvider))->getTransactionsFromInput();

        $this->assertEquals([new TransactionModel('123', '10', 'USD')], $result);
    }
}