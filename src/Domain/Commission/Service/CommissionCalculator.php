<?php

declare(strict_types=1);

namespace App\Domain\Commission\Service;

use App\Support\BcMathHelper;

class CommissionCalculator
{
    use BcMathHelper;

    public function calculate(string $amount, string $currency, string $rate, bool $isEuCard): string
    {
        if ($currency !== 'EUR' || $rate > 0) {
            $amount = bcdiv($amount, $rate, 10);
        }

        $result = bcmul($amount, $isEuCard ? '0.01' : '0.02', 10);

        return $this->bcceil($result, 2);
    }
}