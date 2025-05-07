<?php

declare(strict_types=1);

namespace App\Presentation\Form\Model\Transaction;

use App\Domain\Enum\Interval;
use App\Domain\Enum\TransactionType;
use App\Domain\ValueObject\Money;

final class AddTransaction
{
    private ?string $name = null;
    private ?Money $amount = null;
    private ?Interval $interval = null;
    private ?TransactionType $type = null;
    private ?string $url = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getAmount(): ?Money
    {
        return $this->amount;
    }

    public function setAmount(?Money $amount): void
    {
        $this->amount = $amount;
    }

    public function getType(): ?TransactionType
    {
        return $this->type;
    }

    public function setType(?TransactionType $type): void
    {
        $this->type = $type;
    }

    public function getInterval(): ?Interval
    {
        return $this->interval;
    }

    public function setInterval(?Interval $interval): void
    {
        $this->interval = $interval;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }
}
