<?php

declare(strict_types=1);

namespace App\Domain\Collections;

use App\Domain\Entity\Transaction;
use App\Domain\Enum\Interval;
use App\Domain\Enum\TransactionType;
use App\Domain\ValueObject\Money;
use App\Domain\ValueObject\Percentage;
use App\Domain\ValueObject\Ratio;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @extends ArrayCollection<array-key, Transaction>
 */
final class TransactionCollection extends ArrayCollection
{
    private const int RATIO_CONSEQUENT = 1;

    public function byType(TransactionType $type): TransactionCollection
    {
        return $this->filter(static fn (Transaction $transaction) => $type === $transaction->getType());
    }

    public function byInterval(Interval $interval): TransactionCollection
    {
        return $this->filter(static fn (Transaction $transaction) => $interval === $transaction->getInterval());
    }

    public function getTotalAmountByType(TransactionType $type): Money
    {
        return Money::createFromCents(
            $this->byType($type)->reduce(
                fn (float $amount, Transaction $transaction) => $amount + $transaction->getAmount()->inEuros(),
                0,
            ),
        );
    }

    public function getIncomeExpenseRatio(): Ratio
    {
        $ratio = 0;
        $expenseInCents = $this->getTotalAmountByType(TransactionType::Expense)->inCents();
        if (0.0 !== $expenseInCents) {
            $ratio = $this->getTotalAmountByType(TransactionType::Income)->inCents() / $expenseInCents;
        }

        return Ratio::createFromValue(
            $ratio,
            self::RATIO_CONSEQUENT,
        );
    }

    public function getSavingsRate(): Percentage
    {
        $savingsRate = 100;
        $incomeInCents = $this->getTotalAmountByType(TransactionType::Income)->inCents();
        if (0.0 !== $incomeInCents) {
            $savingsRate = ($incomeInCents - $this->getTotalAmountByType(TransactionType::Expense)->inCents()) / $incomeInCents * 100;
        }

        return Percentage::createFromValue($savingsRate);
    }
}
