<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

final readonly class Percentage implements StatisticInterface
{
    private function __construct(private float $value)
    {
    }

    public static function createFromValue(float $value): self
    {
        return new self($value);
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function format(): string
    {
        return sprintf('%.2f%%', $this->value);
    }
}
