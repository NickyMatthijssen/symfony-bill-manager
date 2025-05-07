<?php

declare(strict_types=1);

namespace App\Presentation\Controller\Dashboard\Transaction;

use App\Presentation\Controller\AbstractController;
use App\Presentation\Form\Handler\Transaction\AddTransactionHandler;
use App\Presentation\Form\Model\Transaction\AddTransaction;
use App\Presentation\Form\Type\Transaction\AddTransactionType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route([
    'en' => '/dashboard/transactions/add',
    'nl' => '/dashboard/transactie/toevoegen',
], name: 'dashboard.transaction.add')]
final class AddController extends AbstractController
{
    public function __construct(
        private readonly FormFactoryInterface $formFactory,
        private readonly AddTransactionHandler $addTransactionHandler,
        private readonly TranslatorInterface $translator,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $form = $this->formFactory->create(AddTransactionType::class, new AddTransaction());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $transaction = $this->addTransactionHandler->handle($form->getData());

            $this->addSuccessAlert(
                $this->translator->trans('dashboard.transaction.add.success', [
                    '%name%' => $transaction->getName(),
                ])
            );

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('dashboard/transaction/add.html.twig', [
            'form' => $form,
        ]);
    }
}
