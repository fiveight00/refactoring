<?php

declare(strict_types=1);

namespace App\Domain\ExchangeRate\Adapter;

interface ExchangeRateAdapterInterface
{
    public function getEurRates(): array;
}