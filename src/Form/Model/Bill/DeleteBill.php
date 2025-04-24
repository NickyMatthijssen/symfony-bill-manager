<?php

declare(strict_types=1);

namespace App\Form\Model\Bill;

use App\Entity\Bill;

final class DeleteBill
{
    public ?bool $confirmation {
        get => $this->confirmation;
        set => $value;
    }

    public function __construct(
        public Bill $bill {
            get => $this->bill;
        },
    ) {
    }
}
