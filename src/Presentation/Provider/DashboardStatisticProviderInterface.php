<?php

declare(strict_types=1);

namespace App\Presentation\Provider;

use App\Domain\Entity\User;
use App\Presentation\Data\DashboardStatistic;

interface DashboardStatisticProviderInterface
{
    /**
     * @return list<DashboardStatistic>
     */
    public function getDashboardStatistic(User $user): array;
}
