<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Currency;
use App\Entity\Money;
use App\Formatter\MoneyFormatter;
use App\Service\ConvertService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class ConvertController
{
    /**
     * @Route("/v1/convert", methods={"GET"})
     */
    public function action(Request $request, ConvertService $convertService): JsonResponse
    {
        $money = new Money(
            (float)$request->query->get('amount'),
            new Currency(
                (string)$request->query->get('from')
            )
        );

        $targetCurrency = new Currency(
            (string)$request->query->get('to')
        );

        $convertService->convert($money, $targetCurrency);

        return new JsonResponse(
            (new MoneyFormatter)->formatOne($money)
        );
    }
}
