<?php

declare(strict_types=1);

namespace App\Application\Income\Command;

use App\Application\Cqrs\CommandInterface;
use App\Domain\Entity\Income;
use App\Domain\Enum\Interval;
use App\Domain\ValueObject\Money;
use Symfony\Component\Messenger\Attribute\AsMessage;

/**
 * @implements CommandInterface<Income>
 */
#[AsMessage]
final readonly class CreateIncomeCommand implements CommandInterface
{
    public function __construct(
        public string $name,
        public Money $amount,
        public Interval $interval,
    ) {
    }
}
