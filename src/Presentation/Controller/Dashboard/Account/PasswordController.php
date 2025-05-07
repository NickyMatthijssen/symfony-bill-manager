<?php

declare(strict_types=1);

namespace App\Presentation\Controller\Dashboard\Account;

use App\Presentation\Controller\AbstractController;
use App\Presentation\Form\Handler\Security\UpdatePasswordHandler;
use App\Presentation\Form\Model\Account\UpdatePassword;
use App\Presentation\Form\Type\Security\UpdatePasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route([
    'en' => '/dashboard/my-account/password',
    'nl' => '/dashboard/mijn-account/wachtwoord',
], name: 'dashboard.account.password')]
final class PasswordController extends AbstractController
{
    public function __construct(private readonly UpdatePasswordHandler $updatePasswordHandler)
    {
    }

    public function __invoke(Request $request): Response
    {
        $form = $this->createForm(UpdatePasswordType::class, new UpdatePassword());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->updatePasswordHandler->handle($form->getData());

            $this->addSuccessAlert('account.security_settings.password.success');

            return $this->redirectToRoute('dashboard.account');
        }

        return $this->render('dashboard/account/password.html.twig', [
            'form' => $form,
        ]);
    }
}
