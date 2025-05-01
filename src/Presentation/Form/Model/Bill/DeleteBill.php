<?php

declare(strict_types=1);

namespace App\Presentation\Form\Model\Bill;

use App\Domain\Entity\Bill;

final class DeleteBill
{
    private bool $confirmed = false;

    public function __construct(
        private readonly Bill $bill,
    ) {
    }

    public function getBill(): Bill
    {
        return $this->bill;
    }

    public function isConfirmed(): bool
    {
        return $this->confirmed;
    }

    public function setConfirmed(bool $confirmed): void
    {
        $this->confirmed = $confirmed;
    }
}
