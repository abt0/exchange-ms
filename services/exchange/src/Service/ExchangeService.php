<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Currency;

interface ExchangeService
{
    /**
     * @return Currency[]
     */
    public function getCurrencies(): array;
    public function getCurrencyRate(Currency $currency): float;
}
