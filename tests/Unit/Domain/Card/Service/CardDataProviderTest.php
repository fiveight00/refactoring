<?php

declare(strict_types=1);

namespace Unit\Domain\Card\Service;

use App\Domain\Card\Adapter\CardDetailsAdapterInterface;
use App\Domain\Card\Service\CardDataProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CardDataProviderTest extends TestCase
{
    public function testIsEuCardPositive(): void
    {
        /** @var CardDetailsAdapterInterface&MockObject $adapter */
        $adapter = $this->createMock(CardDetailsAdapterInterface::class);
        $adapter->method('getCountryCodeByBin')
            ->willReturn('GR');

        $service = new CardDataProvider($adapter);

        $this->assertTrue($service->isEuCard(''));
    }

    public function testIsEuCardNegative(): void
    {
        /** @var CardDetailsAdapterInterface&MockObject $adapter */
        $adapter = $this->createMock(CardDetailsAdapterInterface::class);
        $adapter->method('getCountryCodeByBin')
            ->willReturn('CA');

        $service = new CardDataProvider($adapter);

        $this->assertNotTrue($service->isEuCard(''));
    }
}