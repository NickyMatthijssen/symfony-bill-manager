<?php

declare(strict_types=1);

namespace App\Presentation\Mapper\DashboardStatisticMapper;

use App\Domain\Entity\User;
use App\Presentation\Data\DashboardStatistic;

interface DashboardStatisticMapperInterface
{
    public function map(User $user): DashboardStatistic;
}
