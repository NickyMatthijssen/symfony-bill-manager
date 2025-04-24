<?php

declare(strict_types=1);

namespace App\Form\Model\Bill;

use App\Entity\Bill;
use App\Enum\Interval;
use App\ValueObjects\Money;

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
            $bill->amount,
            $bill->getInterval(),
            $bill->url?->value,
        );
    }
}
