<?php

declare(strict_types=1);

namespace App\Tests\Mock\Domain\Entity;

use App\Domain\Entity\Transaction;
use App\Domain\Entity\User;
use App\Domain\Enum\Interval;
use App\Domain\Enum\TransactionType;
use App\Domain\ValueObject\Base64;
use App\Domain\ValueObject\Money;
use App\Domain\ValueObject\Url;

final class TransactionMock
{
    private function __construct()
    {
    }

    public static function create(
        ?User $user = null,
        string $name = 'mock transaction',
        float $amountInCents = 500,
        Interval $interval = Interval::Monthly,
        TransactionType $transactionType = TransactionType::Expense,
        ?string $url = 'https://example.com',
        ?Base64 $icon = null,
    ): Transaction {
        if (null === $user) {
            $user = UserMock::create();
        }

        $transaction = new Transaction(
            $user,
            $name,
            Money::createFromCents($amountInCents),
            $interval,
            $transactionType,
        );
        $transaction->setIcon($icon);
        $transaction->setUrl(
            $url !== null
                ? Url::createFromString($url)
                : null
        );

        if (null !== $url) {
        }

        return $transaction;
    }
}
