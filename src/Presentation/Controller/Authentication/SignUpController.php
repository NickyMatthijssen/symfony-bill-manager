<?php

declare(strict_types=1);

namespace App\Presentation\Controller\Authentication;

use App\Presentation\Controller\AbstractController;
use App\Presentation\Form\Model\Authentication\SignUp;
use App\Presentation\Form\Model\Security\SignUpFormHandler;
use App\Presentation\Form\Type\Authentication\SignUpType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route([
    'en' => 'authentication/sign-up',
    'nl' => 'authenticatie/registreren',
], name: 'authentication.sign-up')]
final class SignUpController extends AbstractController
{
    public function __construct(
        private readonly FormFactoryInterface $formFactory,
        private readonly SignUpFormHandler $signUpFormHandler,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('dashboard');
        }

        $form = $this->formFactory->create(SignUpType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            assert($data instanceof SignUp);
            $this->signUpFormHandler->handle($data);

            $this->addSuccessAlert('authentication.sign_up.account_created');

            return $this->redirectToRoute('authentication.sign-in');
        }

        return $this->render('authentication/sign-up.html.twig', [
            'form' => $form,
        ]);
    }
}
