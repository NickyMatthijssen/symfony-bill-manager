<?php

declare(strict_types=1);

namespace App\Presentation\Controller\Dashboard;

use App\Domain\Entity\User;
use App\Domain\Enum\TransactionType;
use App\Presentation\Controller\AbstractController;
use App\Presentation\Provider\DashboardStatisticProviderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    public function __construct(
        private readonly DashboardStatisticProviderInterface $dashboardStatisticProvider,
    ) {
    }

    #[Route('/dashboard', name: 'dashboard')]
    public function __invoke(): Response
    {
        $user = $this->getUser();
        assert($user instanceof User);

        return $this->render('dashboard/index.html.twig', [
            'statistics' => $this->dashboardStatisticProvider->getDashboardStatistic($user),
            'incomes' => $user->getBills()->byType(TransactionType::Income),
            'expenses' => $user->getBills()->byType(TransactionType::Expense),
        ]);
    }
}
