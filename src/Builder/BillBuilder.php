<?php

declare(strict_types=1);

namespace App\Builder;

use App\Entity\Bill;
use App\Entity\User;
use App\Enum\Interval;
use App\ValueObjects\Money;
use App\ValueObjects\Url;

final class BillBuilder
{
    private ?string $icon = null;
    private ?Url $url = null;

    public function __construct(
        private User $user,
        private string $name,
        private Money $amount,
        private Interval $interval,
    ) {
    }

    public function build(): Bill
    {
        $bill = new Bill(
            $this->user,
            $this->name,
            $this->amount,
            $this->interval,
        );

        $bill->icon = $this->icon;
        $bill->url = $this->url;

        return $bill;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setAmount(Money $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function setUrl(Url $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function setInterval(Interval $interval): self
    {
        $this->interval = $interval;

        return $this;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }
}
