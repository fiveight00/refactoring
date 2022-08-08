<?php

declare(strict_types=1);

namespace App\Domain\ExchangeRate\Service;

class ExchangeRateService
{
    public function __construct(
        private readonly ExchangeRateDataProvider $exchangeRateProvider,
    ) {
    }

    public function getEurRates(): array
    {
        return $this->exchangeRateProvider->getEurRates();
    }
}