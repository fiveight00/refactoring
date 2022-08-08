<?php

declare(strict_types=1);

namespace Unit\Domain\ExchangeRate\Service;

use App\Domain\ExchangeRate\Adapter\ExchangeRateAdapterInterface;
use App\Domain\ExchangeRate\Service\ExchangeRateDataProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ExchangeRateDataProviderTest extends TestCase
{
    public function testGetEurRates(): void
    {
        $data = ['EUR' => 1];
        /** @var ExchangeRateAdapterInterface&MockObject $adapter */
        $adapter = $this->createMock(ExchangeRateAdapterInterface::class);
        $adapter->method('getEurRates')
            ->willReturn($data);

        $service = new ExchangeRateDataProvider($adapter);

        $this->assertSame($data, $service->getEurRates());
    }
}