<?php

declare(strict_types=1);

namespace App\Domain\ExchangeRate\Client;

use GuzzleHttp\Client;

class ExchangeRateClient
{
    public function __construct(
        private readonly string $exchangeRateUrl,
        private readonly string $apiKey,
    ) {
    }

    public function getLatestEurRates(): array
    {
        $client = new Client();

        return json_decode(
            $client->get($this->exchangeRateUrl, ['headers' => ['apikey' => $this->apiKey]])->getBody()->getContents(),
            true
        );
    }
}