<?php

declare(strict_types=1);

namespace App\Domain\Card\Adapter;

use App\Domain\Card\Client\CardDetailsClient;
use App\Domain\Card\Exception\CardDetailsFormatException;

class CardDetailsAdapter implements CardDetailsAdapterInterface
{
    public function __construct(
        private readonly CardDetailsClient $cardDetailsClient,
    ) {
    }

    public function getCountryCodeByBin(string $bin): string
    {
        $details = $this->cardDetailsClient->getCardDetails($bin);

        if (!isset($details['country']['alpha2'])) {
            throw new CardDetailsFormatException('Unsupported card details format.');
        }

        return $details['country']['alpha2'];
    }
}