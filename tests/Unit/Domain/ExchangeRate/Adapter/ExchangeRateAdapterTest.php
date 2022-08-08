<?php

declare(strict_types=1);

namespace Unit\Domain\ExchangeRate\Adapter;

use App\Domain\ExchangeRate\Adapter\ExchangeRateAdapter;
use App\Domain\ExchangeRate\Client\ExchangeRateClient;
use App\Domain\ExchangeRate\Exception\ExchangeRateFormatException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ExchangeRateAdapterTest extends TestCase
{
    /** @var ExchangeRateClient&MockObject $exchangeRateClient */
    private ExchangeRateClient $exchangeRateClient;

    protected function setUp(): void
    {
        $this->exchangeRateClient = $this->createMock(ExchangeRateClient::class);
    }

    public function testGetEurRates(): void
    {
        $data = ['rates' => ['EUR' => 1]];
        $this->exchangeRateClient->method('getLatestEurRates')
            ->willReturn($data);

        $adapter = new ExchangeRateAdapter($this->exchangeRateClient);

        $this->assertEquals($adapter->getEurRates(), $data['rates']);
    }

    public function testGetEurRatesException(): void
    {
        $this->exchangeRateClient->method('getLatestEurRates')
            ->willReturn([]);

        $this->expectException(ExchangeRateFormatException::class);

        (new ExchangeRateAdapter($this->exchangeRateClient))->getEurRates();
    }
}