<?php

declare(strict_types=1);

namespace App\Mapper\DashboardStatisticMapper;

use App\Data\DashboardStatistic;
use App\Entity\User;
use App\Enum\Interval;
use App\ValueObjects\Money;
use Symfony\Contracts\Translation\TranslatorInterface;

final readonly class TotalWeeklySpendDashboardStatisticMapper implements DashboardStatisticMapperInterface
{
    public function __construct(private TranslatorInterface $translator)
    {
    }

    public function map(User $user): DashboardStatistic
    {
        $amount = 0;

        foreach ($user->getBills() as $bill) {
            $amount += match ($bill->getInterval()) {
                Interval::Yearly => $bill->amount->amount / 52,
                Interval::Monthly => $bill->amount->amount / 4,
                Interval::Weekly => $bill->amount->amount,
            };
        }

        return new DashboardStatistic(
            $this->translator->trans('dashboard.statistic.total_weekly_spend'),
            Money::createFromCents($amount),
        );
    }
}
