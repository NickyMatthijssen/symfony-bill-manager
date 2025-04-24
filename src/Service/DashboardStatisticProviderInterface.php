<?php

declare(strict_types=1);

namespace App\Service;

use App\Data\DashboardStatistic;
use App\Entity\User;

interface DashboardStatisticProviderInterface
{
    /**
     * @return list<DashboardStatistic>
     */
    public function getDashboardStatistic(User $user): array;
}
