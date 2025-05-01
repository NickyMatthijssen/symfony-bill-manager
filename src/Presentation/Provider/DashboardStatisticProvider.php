<?php

declare(strict_types=1);

namespace App\Presentation\Provider;

use App\Domain\Entity\User;
use App\Presentation\Mapper\DashboardStatisticMapper\DashboardStatisticMapperInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

final readonly class DashboardStatisticProvider implements DashboardStatisticProviderInterface
{
    /**
     * @param iterable<int, DashboardStatisticMapperInterface> $dashboardStatisticMappers
     */
    public function __construct(
        #[AutowireIterator('mapper.dashboard_statistic')]
        private iterable $dashboardStatisticMappers,
    ) {
    }


    public function getDashboardStatistic(User $user): array
    {
        $statistics = [];

        foreach ($this->dashboardStatisticMappers as $dashboardStatisticMapper) {
            $statistics[] = $dashboardStatisticMapper->map($user);
        }

        return $statistics;
    }
}
