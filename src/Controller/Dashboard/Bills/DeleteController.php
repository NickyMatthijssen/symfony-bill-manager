<?php

declare(strict_types=1);

namespace App\Controller\Dashboard\Bills;

use App\Controller\AbstractController;
use App\Entity\Bill;
use App\Form\Handler\Bill\DeleteBillHandler;
use App\Form\Model\Bill\DeleteBill;
use App\Form\Type\Bill\DeleteBillType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route([
    'en' => '/dashboard/bills/{id}/delete',
    'nl' => '/dashboard/rekening/{id}/verwijderen',
], name: 'dashboard.bills.delete')]
final class DeleteController extends AbstractController
{
    public function __construct(
        private readonly FormFactoryInterface $formFactory,
        private readonly DeleteBillHandler $deleteBillHandler,
        private readonly TranslatorInterface $translator,
    ) {
    }

    public function __invoke(Request $request, Bill $bill): Response
    {
        $data = new DeleteBill($bill);
        $form = $this->formFactory->create(DeleteBillType::class, $data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->deleteBillHandler->handle($data);

            $this->addSuccessAlert(
                $this->translator->trans('dashboard.bill.delete.success', [
                    '%name%' => $bill->getName(),
                ]),
            );

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('dashboard/bills/delete.html.twig', [
            'form' => $form,
            'bill' => $bill,
        ]);
    }
}
