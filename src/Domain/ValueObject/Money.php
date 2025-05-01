<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use NumberFormatter;

final class Money
{
    public function __construct(
        public int $amount {
        get => $this->amount;
        }
    ) {
    }

    public static function createFromEuros(int|float $amount): self
    {
        return new self((int) round($amount * 100));
    }

    public static function createFromCents(int|float $amount): self
    {
        return new self((int) $amount);
    }

    public function inEuros(): float
    {
        return $this->amount / 100;
    }

    public function format(): string
    {
        return NumberFormatter::create('nl-NL', NumberFormatter::CURRENCY)->formatCurrency($this->inEuros(), 'EUR');
    }

    public function __toString(): string
    {
        return (string) $this->amount;
    }
}
