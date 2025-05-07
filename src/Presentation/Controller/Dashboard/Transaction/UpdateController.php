<?php

declare(strict_types=1);

namespace App\Presentation\Controller\Dashboard\Transaction;

use App\Domain\Entity\Transaction;
use App\Presentation\Controller\AbstractController;
use App\Presentation\Form\Handler\Transaction\UpdateTransactionHandler;
use App\Presentation\Form\Model\Transaction\UpdateTransaction;
use App\Presentation\Form\Type\Transaction\UpdateTransactionType;
use App\Presentation\Voter\Transaction\UpdateTransactionVoter;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route([
    'en' => '/dashboard/transaction/{id}/edit',
    'nl' => '/dashboard/transactie/{id}/bewerken',
], name: 'dashboard.transaction.update')]
#[IsGranted(UpdateTransactionVoter::SUPPORTED_ATTRIBUTE, 'transaction')]
final class UpdateController extends AbstractController
{
    public function __construct(
        private readonly FormFactoryInterface $formFactory,
        private readonly UpdateTransactionHandler $updateTransactionHandler,
        private readonly TranslatorInterface $translator,
    ) {
    }

    public function __invoke(Request $request, Transaction $transaction): Response
    {
        $form = $this->formFactory->create(UpdateTransactionType::class, UpdateTransaction::createFromTransaction($transaction));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->updateTransactionHandler->handle($form->getData());

            $this->addSuccessAlert(
                $this->translator->trans('dashboard.transaction.update.success', [
                    '%name%' => $transaction->getName(),
                ]),
            );

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('dashboard/transaction/update.html.twig', [
            'form' => $form,
        ]);
    }
}
