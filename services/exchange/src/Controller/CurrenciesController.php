<?php

declare(strict_types=1);

namespace App\Controller;

use App\Formatter\CurrencyFormatter;
use App\Service\ExchangeService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class CurrenciesController
{
    /**
     * @Route("/v1/currencies", methods={"GET"})
     */
    public function action(ExchangeService $exchangeService): JsonResponse
    {
        return new JsonResponse(
            (new CurrencyFormatter)->formatAll(
                $exchangeService->getCurrencies()
            )
        );
    }
}
