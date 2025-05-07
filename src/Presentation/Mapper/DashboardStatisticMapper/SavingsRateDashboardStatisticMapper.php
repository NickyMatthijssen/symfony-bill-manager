<?php

declare(strict_types=1);

namespace App\Presentation\Mapper\DashboardStatisticMapper;

use App\Domain\Entity\User;
use App\Domain\ValueObject\Percentage;
use App\Presentation\Data\DashboardStatistic;
use App\Presentation\Enum\Color;

final class SavingsRateDashboardStatisticMapper implements DashboardStatisticMapperInterface
{
    public function map(User $user): DashboardStatistic
    {
        $rate = $user->getBills()->getSavingsRate();

        return new DashboardStatistic(
            'dashboard.statistic.savings_rate',
            $rate,
            $this->getColor($rate),
        );
    }

    public function getColor(Percentage $percentage): Color
    {
        $value = $percentage->getValue();

        if (10 > $value) {
            return Color::Red;
        }

        if (20 >= $value) {
            return Color::Yellow;
        }

        return Color::Green;
    }
}
