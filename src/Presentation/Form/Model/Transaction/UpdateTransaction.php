<?php

declare(strict_types=1);

namespace App\Presentation\Form\Model\Transaction;

use App\Domain\Entity\Transaction;
use App\Domain\Enum\Interval;
use App\Domain\Enum\TransactionType;
use App\Domain\ValueObject\Money;
use InvalidArgumentException;

final class UpdateTransaction
{
    public function __construct(
        private int $transactionId,
        private string $name,
        private Money $amount,
        private Interval $interval,
        private TransactionType $type,
        private ?string $url,
    ) {
    }

    public function getTransactionId(): int
    {
        return $this->transactionId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function setAmount(Money $amount): void
    {
        $this->amount = $amount;
    }

    public function getInterval(): Interval
    {
        return $this->interval;
    }

    public function setInterval(Interval $interval): void
    {
        $this->interval = $interval;
    }

    public function getType(): TransactionType
    {
        return $this->type;
    }

    public function setType(TransactionType $type): void
    {
        $this->type = $type;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public static function createFromTransaction(Transaction $transaction): self
    {
        $id = $transaction->getId();
        if (null === $id) {
            throw new InvalidArgumentException('It is not possible to update a transaction without an id.');
        }

        return new self(
            $id,
            $transaction->getName(),
            $transaction->getAmount(),
            $transaction->getInterval(),
            $transaction->getType(),
            $transaction->getUrl()?->value,
        );
    }
}
