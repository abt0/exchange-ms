<?php

declare(strict_types=1);

namespace App\Entity;

final class Converter
{
    protected $fromCurrency;
    protected $toCurrency;
    protected $amount;

    public function getFromCurrency(): ?string
    {
        return $this->fromCurrency;
    }

    public function setFromCurrency(string $fromCurrency): void
    {
        $this->fromCurrency = $fromCurrency;
    }

    public function getToCurrency(): ?string
    {
        return $this->toCurrency;
    }

    public function setToCurrency(string $toCurrency): void
    {
        $this->toCurrency = $toCurrency;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }
}
