<?php

declare(strict_types=1);

namespace App\Domain\Transaction\Service;

use App\Domain\Transaction\Exception\TransactionFormatException;
use App\Domain\Transaction\Model\TransactionModel;
use InvalidArgumentException;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class TransactionProvider
{
    /**
     * @return TransactionModel[]
     */
    public function getTransactionsFromInput(): array
    {
        if (!isset($_SERVER['argv'][1])) {
            throw new InvalidArgumentException('Path not found.');
        }

        $path = $_SERVER['argv'][1];

        if (!file_exists($path)) {
            throw new FileNotFoundException();
        }

        $result = [];
        $handle = fopen($path, 'r');
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $result[] = $this->makeTransactionModel($line);
            }

            fclose($handle);
        }

        return $result;
    }

    private function makeTransactionModel(string $data): TransactionModel
    {
        $data = json_decode($data, true);

        if (!isset($data['bin']) || !isset($data['amount']) || !isset($data['currency'])) {
            throw new TransactionFormatException('Unsupported transaction format.');
        }

        return new TransactionModel($data['bin'], $data['amount'], $data['currency']);
    }
}