<?php

declare(strict_types=1);

namespace App\Mapper\DashboardStatisticMapper;

use App\Data\DashboardStatistic;
use App\Entity\User;

interface DashboardStatisticMapperInterface
{
    public function map(User $user): DashboardStatistic;
}
