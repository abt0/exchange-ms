<?php

declare(strict_types=1);

namespace App\Service;

use App\HttpClient\HttpClient;

final class ExchangeService
{
    private const MS_EX_URL = 'http://exchange.ms/v1/';

    private $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getCurrencies(): array
    {
        $response = $this->httpClient->get(self::MS_EX_URL . 'currencies');
        return json_decode($response->getBody()->getContents(), true);
    }

    public function convert(string $fromCurrency, string $toCurrency, float $amount): float
    {
        $response = $this->httpClient->get(
            self::MS_EX_URL . 'convert?from=' . $fromCurrency . '&to=' . $toCurrency . '&amount=' . $amount
        );

        $data = json_decode($response->getBody()->getContents());
        return (float)$data->amount;
    }
}
