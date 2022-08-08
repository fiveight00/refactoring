<?php

declare(strict_types=1);

namespace App\Domain\ExchangeRate\Adapter;

use App\Domain\ExchangeRate\Client\ExchangeRateClient;
use App\Domain\ExchangeRate\Exception\ExchangeRateFormatException;

class ExchangeRateAdapter implements ExchangeRateAdapterInterface
{
    public function __construct(private readonly ExchangeRateClient $exchangeRateClient)
    {
    }

    public function getEurRates(): array
    {
        $data = $this->exchangeRateClient->getLatestEurRates();

        if (!isset($data['rates'])) {
            throw new ExchangeRateFormatException('Unsupported exchange rate format.');
        }

        return $data['rates'];
    }
}