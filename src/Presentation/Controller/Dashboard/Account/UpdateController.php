<?php

declare(strict_types=1);

namespace App\Presentation\Controller\Dashboard\Account;

use App\Domain\Entity\User;
use App\Presentation\Form\Handler\Account\UpdateAccountFormHandler;
use App\Presentation\Form\Model\Account\UpdateAccount;
use App\Presentation\Form\Type\Account\UpdateAccountType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route([
    'en' => '/dashboard/my-account/edit',
    'nl' => '/dashboard/mijn-account/bewerken',
], name: 'dashboard.account.edit')]
final class UpdateController extends AbstractController
{
    public function __construct(
        private readonly FormFactoryInterface $formFactory,
        private readonly UpdateAccountFormHandler $updateAccountFormHandler,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $user = $this->getUser();
        assert($user instanceof User);

        $data = UpdateAccount::createFromUser($user);
        $form = $this->formFactory->create(UpdateAccountType::class, $data);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->updateAccountFormHandler->handle($data);
            return $this->redirectToRoute('dashboard.account');
        }

        return $this->render('dashboard/account/edit.html.twig', [
            'form' => $form,
        ]);
    }
}
