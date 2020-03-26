<?php

declare(strict_types=1);

namespace App\Formatter;

use App\Entity\Money;

final class MoneyFormatter extends AbstractFormatter
{
    protected function formatFunction(object $money): array
    {
        /** @var Money $money */
        return [
            'amount' => $money->amount(),
            'currency' => $money->currency()->code(),
        ];
    }

    protected static function entityClass(): string
    {
        return Money::class;
    }
}
