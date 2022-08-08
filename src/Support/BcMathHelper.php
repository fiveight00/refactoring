<?php

declare(strict_types=1);

namespace App\Support;

trait BcMathHelper
{
    public function bcceil($number, int $precision = 0): string
    {
        $delta = bcdiv('9', bcpow('10', (string)($precision + 1)), $precision + 1);
        $number = bcadd($number, $delta, $precision + 1);

        return bcadd($number, '0', $precision);
    }
}