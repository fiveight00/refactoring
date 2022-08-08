<?php

declare(strict_types=1);

namespace App\Domain\Card\Adapter;

interface CardDetailsAdapterInterface
{
    public function getCountryCodeByBin(string $bin): string;
}