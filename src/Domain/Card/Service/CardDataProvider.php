<?php

declare(strict_types=1);

namespace App\Domain\Card\Service;

use App\Domain\Card\Adapter\CardDetailsAdapterInterface;

class CardDataProvider
{
    public function __construct(
        private readonly CardDetailsAdapterInterface $cardDetailsAdapter,
    ) {
    }

    public function isEuCard(string $bin): bool
    {
        $cardDetails = $this->cardDetailsAdapter->getCountryCodeByBin($bin);

        return in_array(strtoupper($cardDetails), $this->getEuCountryCodes());
    }

    private function getEuCountryCodes(): array
    {
        return [
            'AT',
            'BE',
            'BG',
            'CY',
            'CZ',
            'DE',
            'DK',
            'EE',
            'ES',
            'FI',
            'FR',
            'GR',
            'HR',
            'HU',
            'IE',
            'IT',
            'LT',
            'LU',
            'LV',
            'MT',
            'NL',
            'PO',
            'PT',
            'RO',
            'SE',
            'SI',
            'SK'
        ];
    }
}