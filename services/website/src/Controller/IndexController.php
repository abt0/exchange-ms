<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Converter;
use App\Service\ExchangeService;
use App\Service\HistoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

final class IndexController extends AbstractController
{
    /**
     * @Route("/", methods={"GET", "POST"})
     */
    public function action(
        Request $request,
        ExchangeService $exchangeService,
        HistoryService $historyService
    ): Response {
        $task = new Converter();

        $currencies = array_map(
            static function($currency) {
                return $currency['code'];
            },
            $exchangeService->getCurrencies()
        );

        $currencies = array_combine($currencies, $currencies);

        $form = $this->createFormBuilder($task)
            ->add(
                'fromCurrency',
                ChoiceType::class, [
                'choices' => $currencies,
            ])
            ->add(
                'toCurrency',
                ChoiceType::class, [
                'choices' => $currencies,
            ])
            ->add('amount', TextType::class)
            ->add('convert', SubmitType::class, ['label' => 'Convert'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Converter $convert */
            $convert = $form->getData();

            $amount = $exchangeService->convert(
                $convert->getFromCurrency(),
                $convert->getToCurrency(),
                $convert->getAmount()
            );

            $historyService->add([
                'fromCurrency' => $convert->getFromCurrency(),
                'toCurrency' => $convert->getToCurrency(),
                'amount' => $convert->getAmount(),
                'newAmount' => $amount,
            ]);
        }

        $history = $historyService->getAll();

        return $this->render('index/index.html.twig', [
            'form' => $form->createView(),
            'history' => $history,
        ]);
    }
}
