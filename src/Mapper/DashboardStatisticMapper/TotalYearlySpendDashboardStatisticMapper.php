<?php

declare(strict_types=1);

namespace App\Mapper\DashboardStatisticMapper;

use App\Data\DashboardStatistic;
use App\Entity\User;
use App\Enum\Interval;
use App\ValueObjects\Money;
use Symfony\Contracts\Translation\TranslatorInterface;

final readonly class TotalYearlySpendDashboardStatisticMapper implements DashboardStatisticMapperInterface
{
    public function __construct(private TranslatorInterface $translator)
    {
    }

    public function map(User $user): DashboardStatistic
    {
        $amount = 0;

        foreach ($user->getBills() as $bill) {
            $amount += $bill->amount->amount * match ($bill->getInterval()) {
                Interval::Yearly => 1,
                Interval::Monthly => 12,
                Interval::Weekly => 52,
            };
        }

        return new DashboardStatistic(
            $this->translator->trans('dashboard.statistic.total_yearly_spend'),
            Money::createFromCents($amount),
        );
    }
}
