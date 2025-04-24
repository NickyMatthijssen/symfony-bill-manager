<?php

declare(strict_types=1);

namespace App\Controller\Dashboard\Bills;

use App\Controller\AbstractController;
use App\Entity\User;
use App\Form\Handler\Bill\AddBillHandler;
use App\Form\Model\Bill\AddBill;
use App\Form\Type\Bill\AddBillType;
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
        $user = $this->getUser();
        assert($user instanceof User);

        $form = $this->formFactory->create(AddBillType::class, new AddBill($user));
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
