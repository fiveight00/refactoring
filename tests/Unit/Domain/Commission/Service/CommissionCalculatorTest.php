<?php

declare(strict_types=1);

namespace Unit\Domain\Commission\Service;

use App\Domain\Commission\Service\CommissionCalculator;
use PHPUnit\Framework\TestCase;

class CommissionCalculatorTest extends TestCase
{
    /**
     * @dataProvider calculateDataProvider
     */
    public function testCalculate(array $payload, string $result): void
    {
        $data = (new CommissionCalculator())
            ->calculate(
                $payload['amount'],
                $payload['currency'],
                $payload['rate'],
                $payload['isEuCard']
            );

        $this->assertEquals($result, $data);
    }

    /**
     * @dataProvider bcceilDataProvider
     */
    public function testBcceil(string $payload, string $result): void
    {
        $data = (new CommissionCalculator())->bcceil($payload, 2);

        $this->assertEquals($result, $data);
    }

    public function calculateDataProvider(): array
    {
        return [
            'case-1' => [
                'payload' => [
                    'amount' => '100.00',
                    'currency' => 'EUR',
                    'rate' => '1',
                    'isEuCard' => true
                ],
                'result' => '1.00'
            ],
            'case-2' => [
                'payload' => [
                    'amount' => '100.00',
                    'currency' => 'EUR',
                    'rate' => '1',
                    'isEuCard' => false
                ],
                'result' => '2.00'
            ],
            'case-3' => [
                'payload' => [
                    'amount' => '130.00',
                    'currency' => 'USD',
                    'rate' => '1.1',
                    'isEuCard' => true
                ],
                'result' => '1.19'
            ],
            'case-4' => [
                'payload' => [
                    'amount' => '130.00',
                    'currency' => 'USD',
                    'rate' => '1.1',
                    'isEuCard' => false
                ],
                'result' => '2.37'
            ]
        ];
    }

    public function bcceilDataProvider(): array
    {
        return [
            'case-1' => [
                'payload' => '0.93241',
                'result' => '0.94',
            ],
            'case-2' => [
                'payload' => '1',
                'result' => '1.00',
            ],
            'case-3' => [
                'payload' => '1.1',
                'result' => '1.10'
            ],
            'case-4' => [
                'payload' => '12.4853531308',
                'result' => '12.49'
            ]
        ];
    }
}