<?php

declare(strict_types=1);

namespace App\Application\Transaction\Command\UpdateTransaction;

use App\Application\Cqrs\CommandInterface;
use App\Domain\Enum\Interval;
use App\Domain\ValueObject\Money;
use Symfony\Component\Messenger\Attribute\AsMessage;

/**
 * @implements CommandInterface<void>
 */
#[AsMessage]
final readonly class UpdateTransactionCommand implements CommandInterface
{
    public function __construct(
        public int $transactionId,
        public string $name,
        public Money $amount,
        public Interval $interval,
        public ?string $url,
    ) {
    }
}
