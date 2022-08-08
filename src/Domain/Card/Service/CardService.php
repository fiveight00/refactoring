<?php

declare(strict_types=1);

namespace App\Domain\Card\Service;

class CardService
{
    public function __construct(
        private readonly CardDataProvider $cardDataProvider,
    ) {
    }

    public function isEuCard(string $bin): bool
    {
        return $this->cardDataProvider->isEuCard($bin);
    }
}