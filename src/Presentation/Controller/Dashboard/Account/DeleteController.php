<?php

declare(strict_types=1);

namespace App\Presentation\Controller\Dashboard\Account;

use App\Domain\Entity\User;
use App\Presentation\Controller\AbstractController;
use App\Presentation\Form\Handler\Security\DeleteAccountFormHandler;
use App\Presentation\Form\Model\Account\DeleteAccount;
use App\Presentation\Form\Type\Security\DeleteAccountType;
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

        $form = $this->createForm(DeleteAccountType::class, new DeleteAccount($user));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->deleteAccountFormHandler->handle($form->getData());

            $this->addInformationAlert('account.delete.successful');

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('dashboard/account/delete.html.twig', [
            'form' => $form,
        ]);
    }
}
