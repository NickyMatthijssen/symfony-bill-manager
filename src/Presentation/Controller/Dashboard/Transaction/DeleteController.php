<?php

declare(strict_types=1);

namespace App\Presentation\Controller\Dashboard\Transaction;

use App\Domain\Entity\Transaction;
use App\Presentation\Controller\AbstractController;
use App\Presentation\Form\Handler\Transaction\DeleteTransactionHandler;
use App\Presentation\Form\Model\Transaction\DeleteTransaction;
use App\Presentation\Form\Type\Transaction\DeleteTransactionType;
use App\Presentation\Voter\Transaction\DeleteTransactionVoter;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route([
    'en' => '/dashboard/transaction/{id}/delete',
    'nl' => '/dashboard/transactie/{id}/verwijderen',
], name: 'dashboard.transaction.delete')]
#[IsGranted(DeleteTransactionVoter::SUPPORTED_ATTRIBUTE, 'transaction')]
final class DeleteController extends AbstractController
{
    public function __construct(
        private readonly FormFactoryInterface $formFactory,
        private readonly DeleteTransactionHandler $deleteBillHandler,
        private readonly TranslatorInterface $translator,
    ) {
    }

    public function __invoke(Request $request, Transaction $transaction): Response
    {
        $form = $this->formFactory->create(DeleteTransactionType::class, DeleteTransaction::createFromTransaction($transaction));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->deleteBillHandler->handle($form->getData());

            $this->addSuccessAlert(
                $this->translator->trans('dashboard.bill.delete.success', [
                    '%name%' => $transaction->getName(),
                ]),
            );

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('dashboard/transaction/delete.html.twig', [
            'form' => $form,
            'bill' => $transaction,
        ]);
    }
}
