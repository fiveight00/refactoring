<?php

declare(strict_types=1);

namespace App\Domain\ExchangeRate\Service;

use App\Domain\ExchangeRate\Adapter\ExchangeRateAdapterInterface;

class ExchangeRateDataProvider
{
    public function __construct(
        private readonly ExchangeRateAdapterInterface $exchangeRateAdapter,
    ) {
    }

    public function getEurRates(): array
    {
        return $this->exchangeRateAdapter->getEurRates();
    }
}