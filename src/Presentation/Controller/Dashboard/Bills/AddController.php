<?php

declare(strict_types=1);

namespace App\Presentation\Controller\Dashboard\Bills;

use App\Presentation\Controller\AbstractController;
use App\Presentation\Form\Handler\Bill\AddBillHandler;
use App\Presentation\Form\Model\Bill\AddBill;
use App\Presentation\Form\Type\Bill\AddBillType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route([
    'en' => '/dashboard/bills/add',
    'nl' => '/dashboard/rekening/toevoegen',
], name: 'dashboard.bills.add')]
final class AddController extends AbstractController
{
    public function __construct(
        private readonly FormFactoryInterface $formFactory,
        private readonly AddBillHandler $addBillHandler,
        private readonly TranslatorInterface $translator,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $form = $this->formFactory->create(AddBillType::class, new AddBill());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $bill = $this->addBillHandler->handle($form->getData());

            $this->addSuccessAlert(
                $this->translator->trans('dashboard.bill.add.success', [
                    '%name%' => $bill->getName(),
                ])
            );

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('dashboard/bills/add.html.twig', [
            'form' => $form,
        ]);
    }
}
