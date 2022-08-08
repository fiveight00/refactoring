<?php

declare(strict_types=1);

namespace Unit\Domain\Transaction\Service;

use App\Domain\Transaction\Service\TransactionProvider;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class TransactionProviderTest extends TestCase
{
    public function testGetTransactionsFromInputException1(): void
    {
        $this->expectException(InvalidArgumentException::class);

        (new TransactionProvider())->getTransactionsFromInput();
    }

    public function testGetTransactionsFromInputException2(): void
    {
        $_SERVER['argv'][1] = 'test.txt';

        $this->expectException(FileNotFoundException::class);

        (new TransactionProvider())->getTransactionsFromInput();
    }
}