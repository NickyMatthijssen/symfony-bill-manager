<?php

declare(strict_types=1);

namespace App\Presentation\Mapper\DashboardStatisticMapper;

use App\Domain\Entity\User;
use App\Domain\Enum\Interval;
use App\Domain\ValueObject\Money;
use App\Presentation\Data\DashboardStatistic;
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
                Interval::Yearly => $bill->getAmount()->amount / 12,
                Interval::Monthly => $bill->getAmount()->amount,
                Interval::Weekly => $bill->getAmount()->amount * 4,
            };
        }

        return new DashboardStatistic(
            $this->translator->trans('dashboard.statistic.total_monthly_spend'),
            Money::createFromCents($amount),
        );
    }
}
