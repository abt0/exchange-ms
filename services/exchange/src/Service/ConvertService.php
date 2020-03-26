<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Currency;
use App\Entity\Money;

final class ConvertService
{
    private $exchangeService;

    public function __construct(ExchangeService $exchangeService)
    {
        $this->exchangeService = $exchangeService;
    }

    public function convert(Money $money, Currency $targetCurrency): void
    {
        $currentRate = $this->exchangeService->getCurrencyRate($money->currency());
        $targetRate = $this->exchangeService->getCurrencyRate($targetCurrency);

        $rate = $targetRate / $currentRate;

        $money
            ->setAmount(round($money->amount() * $rate, 2))
            ->setCurrency($targetCurrency);

    }
}
