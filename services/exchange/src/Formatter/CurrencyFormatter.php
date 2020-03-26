<?php

declare(strict_types=1);

namespace App\Formatter;

use App\Entity\Currency;

final class CurrencyFormatter extends AbstractFormatter
{
    protected function formatFunction(object $currency): array
    {
        /** @var Currency $currency */
        return [
            'code' => $currency->code(),
        ];
    }

    protected static function entityClass(): string
    {
        return Currency::class;
    }
}
