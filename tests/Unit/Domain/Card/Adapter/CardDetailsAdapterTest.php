<?php

declare(strict_types=1);

namespace Unit\Domain\Card\Adapter;

use App\Domain\Card\Adapter\CardDetailsAdapter;
use App\Domain\Card\Client\CardDetailsClient;
use App\Domain\Card\Exception\CardDetailsFormatException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CardDetailsAdapterTest extends TestCase
{
    /** @var CardDetailsClient&MockObject $cardDetailsClient */
    private CardDetailsClient $cardDetailsClient;

    protected function setUp(): void
    {
        $this->cardDetailsClient = $this->createMock(CardDetailsClient::class);
    }

    public function testGetCountryCodeByBin(): void
    {
        $data = ['country' => ['alpha2' => 'GR']];
        $this->cardDetailsClient->method('getCardDetails')
            ->willReturn($data);

        $adapter = new CardDetailsAdapter($this->cardDetailsClient);

        $this->assertEquals($adapter->getCountryCodeByBin(''), $data['country']['alpha2']);
    }

    public function testGetCountryCodeByBinException(): void
    {
        $this->cardDetailsClient->method('getCardDetails')
            ->willReturn([]);

        $this->expectException(CardDetailsFormatException::class);

        (new CardDetailsAdapter($this->cardDetailsClient))->getCountryCodeByBin('');
    }
}