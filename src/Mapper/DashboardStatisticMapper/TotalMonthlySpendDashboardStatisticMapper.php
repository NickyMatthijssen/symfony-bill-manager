<?php

declare(strict_types=1);

namespace App\Mapper\DashboardStatisticMapper;

use App\Data\DashboardStatistic;
use App\Entity\User;
use App\Enum\Interval;
use App\ValueObjects\Money;
use Symfony\Contracts\Translation\TranslatorInterface;

final readonly class TotalMonthlySpendDashboardStatisticMapper implements DashboardStatisticMapperInterface
{
    public function __construct(private TranslatorInterface $translator)
    {
    }

    public function map(User $user): DashboardStatistic
    {
        $amount = 0;

        foreach ($user->getBills() as $bill) {
            $amount += match ($bill->getInterval()) {
                Interval::Yearly => $bill->amount->amount / 12,
                Interval::Monthly => $bill->amount->amount,
                Interval::Weekly => $bill->amount->amount * 4,
            };
        }

        return new DashboardStatistic(
            $this->translator->trans('dashboard.statistic.total_monthly_spend'),
            Money::createFromCents($amount),
        );
    }
}
