<?php

declare(strict_types=1);

namespace App\Presentation\Controller\Dashboard\Bills;

use App\Domain\Entity\Bill;
use App\Presentation\Controller\AbstractController;
use App\Presentation\Form\Handler\Bill\UpdateBillHandler;
use App\Presentation\Form\Model\Bill\UpdateBill;
use App\Presentation\Form\Type\Bill\UpdateBillType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route([
    'en' => '/dashboard/bills/{id}/edit',
    'nl' => '/dashboard/rekening/{id}/bewerken',
], name: 'dashboard.bills.edit')]
final class EditController extends AbstractController
{
    public function __construct(
        private readonly FormFactoryInterface $formFactory,
        private readonly UpdateBillHandler $updateBillHandler,
        private readonly TranslatorInterface $translator,
    ) {
    }

    public function __invoke(Request $request, Bill $bill): Response
    {
        $updateBill = UpdateBill::createFromBill($bill);

        $form = $this->formFactory->create(UpdateBillType::class, $updateBill);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->updateBillHandler->handle($bill, $updateBill);

            $this->addSuccessAlert(
                $this->translator->trans('dashboard.bill.edit.success', [
                    '%name%' => $bill->getName(),
                ]),
            );

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('dashboard/bills/edit.html.twig', [
            'bill' => $bill,
            'form' => $form,
        ]);
    }
}
