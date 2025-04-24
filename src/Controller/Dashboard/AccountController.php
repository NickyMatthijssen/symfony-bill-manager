<?php

declare(strict_types=1);

namespace App\Controller\Dashboard;

use App\Entity\User;
use App\Form\Type\Account\RegenerateAvatarType;
use App\Service\AvatarGeneratorInterface;
use App\Service\PersonalInformationProviderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Uid\Uuid;

#[Route([
    'en' => '/dashboard/my-account',
    'nl' => '/dashboard/mijn-account',
], name: 'dashboard.account')]
final class AccountController extends AbstractController
{
    public function __construct(private readonly PersonalInformationProviderInterface $personalInformationProvider)
    {
    }

    public function __invoke(Request $request): Response
    {
        $user = $this->getUser();
        assert($user instanceof User);

        return $this->render('dashboard/account/index.html.twig', [
            'user' => $user,
            'information' => $this->personalInformationProvider->getPersonalInformation($user),
        ]);
    }
}
