<?php

declare(strict_types=1);

namespace App\Application\Bill\Command\CreateBill;

use App\Application\Cqrs\CommandInterface;
use App\Domain\Entity\Bill;
use App\Domain\Entity\User;
use App\Domain\Enum\Interval;
use App\Domain\ValueObject\Money;
use App\Domain\ValueObject\Url;
use Symfony\Component\Messenger\Attribute\AsMessage;

/**
 * @implements CommandInterface<Bill>
 */
#[AsMessage]
final readonly class CreateBillCommand implements CommandInterface
{
    public function __construct(
        public User $user,
        public string $name,
        public Money $amount,
        public Interval $interval,
        public ?Url $url,
    ) {
    }
}
