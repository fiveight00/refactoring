<?php

declare(strict_types=1);

namespace App\Domain\Commission\Service;

class CommissionService
{
    public function __construct(
        private readonly CommissionCalculator $commissionCalculator,
    ) {
    }

    public function calculateCommission(string $amount, string $currency, string $rate, bool $isEuCard): string
    {
        return $this->commissionCalculator->calculate($amount, $currency, $rate, $isEuCard);
    }
}