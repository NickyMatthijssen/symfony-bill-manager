<?php

declare(strict_types=1);

namespace App\Controller\Dashboard\Account;

use App\Constant\TranslationDomain;
use App\Controller\AbstractController;
use App\Entity\User;
use App\Form\Handler\Account\UpdatePasswordHandler;
use App\Form\Model\Account\UpdatePassword;
use App\Form\Type\Account\UpdatePasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route([
    'en' => '/dashboard/my-account/password',
    'nl' => '/dashboard/mijn-account/wachtwoord',
], name: 'dashboard.account.password')]
final class PasswordController extends AbstractController
{
    public function __construct(
        private readonly UpdatePasswordHandler $updatePasswordHandler,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $user = $this->getUser();
        assert($user instanceof User);

        $data = new UpdatePassword($user);
        $form = $this->createForm(UpdatePasswordType::class, $data);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->updatePasswordHandler->handle($data);

            $this->addSuccessAlert('account.security_settings.password.success');

            return $this->redirectToRoute('dashboard.account');
        }

        return $this->render('dashboard/account/password.html.twig', [
            'form' => $form,
        ]);
    }
}
