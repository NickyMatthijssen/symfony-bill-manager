<?php

declare(strict_types=1);

namespace App\Application\Transaction\Command\CreateTransaction;

use App\Application\Cqrs\CommandInterface;
use App\Domain\Entity\Transaction;
use App\Domain\Entity\User;
use App\Domain\Enum\Interval;
use App\Domain\Enum\TransactionType;
use App\Domain\ValueObject\Money;
use App\Domain\ValueObject\Url;
use Symfony\Component\Messenger\Attribute\AsMessage;

/**
 * @implements CommandInterface<Transaction>
 */
#[AsMessage]
final readonly class CreateTransactionCommand implements CommandInterface
{
    public function __construct(
        public string $userIdentifier,
        public string $name,
        public Money $amount,
        public Interval $interval,
        public TransactionType $type,
        public ?Url $url,
    ) {
    }
}
