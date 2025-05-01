<?php

declare(strict_types=1);

namespace App\Presentation\Controller\Authentication;

use App\Presentation\Controller\AbstractController;
use App\Presentation\Form\Type\Authentication\SignInType;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route([
    'en' => 'authentication/sign-in',
    'nl' => 'authenticatie/inloggen',
], name: 'authentication.sign-in')]
final class SignInController extends AbstractController
{
    public function __construct(
        private readonly AuthenticationUtils $authenticationUtils,
        private readonly FormFactoryInterface $formFactory,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $authenticationError = $this->authenticationUtils->getLastAuthenticationError();

        $form = $this->formFactory->create(SignInType::class, [
            'email' => $this->authenticationUtils->getLastUsername(),
        ]);
        $form->handleRequest($request);
        if (null !== $authenticationError) {
            $form->addError(new FormError($authenticationError->getMessage()));
        }

        return $this->render('authentication/sign-in.html.twig', [
            'form' => $form,
        ]);
    }
}
