<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Currency;
use App\HttpClient\HttpClient;
use Psr\Cache\CacheItemPoolInterface;

final class RestApiExchangeService implements ExchangeService
{
    private const BASE_CURRENCY = 'EUR';

    private const CACHE_KEY_CURRENCIES = 'MS_EX_CURRENCIES';

    private $cache;
    private $httpClient;

    public function __construct(CacheItemPoolInterface $cache, HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->cache = $cache;
    }

    public function getCurrencies(): array
    {
        $baseCurrency = new Currency(self::BASE_CURRENCY);

        return [$baseCurrency] + array_map(
            static function (string $currencyCode) {
                return new Currency($currencyCode);
            },
            array_keys($this->fetchRates())
        );
    }

    public function getCurrencyRate(Currency $currency): float
    {
        if (self::BASE_CURRENCY === $currency->code()) {
            return 1.;
        }

        return $this->fetchRates()[$currency->code()];
    }

    private function fetchRates(): array
    {
        $item = $this->cache->getItem(self::CACHE_KEY_CURRENCIES);

        /** @todo Make Redis working or use DB */
        if (!$item->isHit()) {
            $response = $this->httpClient->get(
                'https://api.exchangeratesapi.io/latest?base=' . self::BASE_CURRENCY
            );

            $contents = json_decode($response->getBody()->getContents(), true);
            $item->set($contents['rates']);

            $this->cache->save($item);
        }

        return $item->get();
    }
}
