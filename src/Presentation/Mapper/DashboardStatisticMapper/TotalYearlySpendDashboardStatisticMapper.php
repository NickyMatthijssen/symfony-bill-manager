<?php

declare(strict_types=1);

namespace App\Presentation\Mapper\DashboardStatisticMapper;

use App\Domain\Entity\User;
use App\Domain\Enum\Interval;
use App\Domain\Enum\TransactionType;
use App\Domain\ValueObject\Money;
use App\Presentation\Data\DashboardStatistic;
use Symfony\Contracts\Translation\TranslatorInterface;

final readonly class TotalYearlySpendDashboardStatisticMapper implements DashboardStatisticMapperInterface
{
    public function __construct(private TranslatorInterface $translator)
    {
    }

    public function map(User $user): DashboardStatistic
    {
        $amount = 0;

        foreach ($user->getBills()->byType(TransactionType::Expense) as $bill) {
            $amount += $bill->getAmount()->amount * match ($bill->getInterval()) {
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
