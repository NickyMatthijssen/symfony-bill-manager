<?php

declare(strict_types=1);

namespace App\Controller\Dashboard;

use App\Entity\User;
use App\Service\DashboardStatisticProviderInterface;
use App\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class IndexController extends AbstractController
{
    public function __construct(private readonly DashboardStatisticProviderInterface $dashboardStatisticProvider)
    {
    }

    #[Route('/dashboard', name: 'dashboard')]
    public function __invoke(UserProviderInterface $userProvider): Response
    {
        $user = $this->getUser();
        assert($user instanceof User);

        return $this->render('dashboard/index.html.twig', [
            'statistics' => $this->dashboardStatisticProvider->getDashboardStatistic($user),
            'bills' => $user->getBills(),
        ]);
    }
}
