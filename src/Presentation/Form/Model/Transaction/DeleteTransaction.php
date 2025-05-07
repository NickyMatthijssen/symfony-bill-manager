<?php

declare(strict_types=1);

namespace App\Presentation\Form\Model\Transaction;

use App\Domain\Entity\Transaction;
use InvalidArgumentException;

final class DeleteTransaction
{
    private bool $confirmed = false;

    public function __construct(
        private readonly int $transactionId,
    ) {
    }

    public function getTransactionId(): int
    {
        return $this->transactionId;
    }

    public function isConfirmed(): bool
    {
        return $this->confirmed;
    }

    public function setConfirmed(bool $confirmed): void
    {
        $this->confirmed = $confirmed;
    }

    public static function createFromTransaction(Transaction $transaction): self
    {
        $transactionId = $transaction->getId();
        if (null === $transactionId) {
            throw new InvalidArgumentException('It is not possible to update a transaction without an id.');
        }

        return new self($transactionId);
    }
}
