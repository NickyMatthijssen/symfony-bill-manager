<?php

declare(strict_types=1);

namespace App\Controller\Dashboard\Account;

use App\Controller\AbstractController;
use App\Entity\User;
use App\Form\Handler\Account\DeleteAccountFormHandler;
use App\Form\Model\Account\DeleteAccount;
use App\Form\Type\Account\DeleteAccountType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route([
    'en' => '/dashboard/my-account/delete',
    'nl' => '/dashboard/mijn-account/verwijderen',
], name: 'dashboard.account.delete')]
final class DeleteController extends AbstractController
{
    public function __construct(
        private readonly DeleteAccountFormHandler $deleteAccountFormHandler,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $user = $this->getUser();
        assert($user instanceof User);

        $data = new DeleteAccount($user);
        $form = $this->createForm(DeleteAccountType::class, $data);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            assert($data instanceof DeleteAccount);
            $this->deleteAccountFormHandler->handle($data);

            $this->addInformationAlert('account.delete.successful');

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('dashboard/account/delete.html.twig', [
            'form' => $form,
        ]);
    }
}
