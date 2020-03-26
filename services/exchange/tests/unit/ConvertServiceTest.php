<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\Currency;
use App\Entity\Money;
use App\Service\ConvertService;
use App\Service\ExchangeService;
use PHPUnit\Framework\TestCase;

final class ConvertServiceTest extends TestCase
{
    private $convertService;

    public function setUp(): void
    {
        parent::setUp();

        $this->convertService = new ConvertService(new class implements ExchangeService {
            public function getCurrencies(): array
            {
                return [
                    new Currency('EUR'),
                    new Currency('USD'),
                    new Currency('GBP'),
                    new Currency('RUB'),
                ];
            }

            public function getCurrencyRate(Currency $currency): float
            {
                $rates = [
                    'EUR' => 1.,
                    'USD' => 1.0783,
                    'GBP' => 0.9297,
                    'RUB' => 86.08,
                ];

                return $rates[$currency->code()];
            }
        });
    }

    public function dataProvider(): array
    {
        return [
            'EUR -> RUB' => [
                25.5,
                'EUR',
                'RUB',
                2195.04,
            ],
            'GBP -> USD' => [
                145.25,
                'GBP',
                'USD',
                168.47,
            ],
            'USD -> EUR' => [
                11.67,
                'USD',
                'EUR',
                10.82,
            ],
        ];
    }

    /** @dataProvider dataProvider */
    public function testConvert(
        float $amount,
        string $fromCurrency,
        string $toCurrency,
        float $result
    ): void {
        $money = new Money(
            $amount,
            new Currency($fromCurrency)
        );

        $this->convertService->convert(
            $money,
            new Currency($toCurrency)
        );

        self::assertEquals($result, $money->amount());
    }
}
