<?php

declare(strict_types=1);

namespace App\Presentation\Form\Model\Bill;

use App\Domain\Entity\Bill;
use App\Domain\Enum\Interval;
use App\Domain\ValueObject\Money;

final class UpdateBill
{
    public function __construct(
        public string $name {
        get => $this->name;
        set => $value;
        },
        public Money $amount {
        get => $this->amount;
        set => $value;
        },
        public Interval $interval {
        get => $this->interval;
        set => $value;
        },
        public ?string $url {
        get => $this->url;
        set => $value;
        },
    ) {
    }

    public static function createFromBill(Bill $bill): self
    {
        return new self(
            $bill->getName(),
            $bill->getAmount(),
            $bill->getInterval(),
            $bill->getUrl()?->value,
        );
    }
}
