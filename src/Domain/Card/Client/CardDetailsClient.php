<?php

declare(strict_types=1);

namespace App\Domain\Card\Client;

use GuzzleHttp\Client;

class CardDetailsClient
{
    public function __construct(
        private readonly string $cardCheckUrl,
    ) {
    }

    public function getCardDetails(string $bin): array
    {
        $client = new Client(['base_uri' => $this->cardCheckUrl]);

        return json_decode($client->get($bin)->getBody()->getContents(), true);
    }
}