<?php

declare(strict_types=1);

namespace App\Presentation\Mapper\DashboardStatisticMapper;

use App\Domain\Entity\User;
use App\Presentation\Data\DashboardStatistic;

final class IncomeExpenseRatioDashboardStatisticMapper implements DashboardStatisticMapperInterface
{
    public function map(User $user): DashboardStatistic
    {
        return new DashboardStatistic(
            'dashboard.statistic.income_expense_ratio',
            $user->getBills()->getIncomeExpenseRatio(),
        );
    }
}
