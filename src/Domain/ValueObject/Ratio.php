<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

final readonly class Ratio implements StatisticInterface
{
    private function __construct(
        private float $antecedent,
        private float $consequent,
    ) {
    }

    public static function createFromValue(float $antecedent, float $consequent): self
    {
        return new self($antecedent, $consequent);
    }

    public function getAntecedent(): float
    {
        return $this->antecedent;
    }

    public function getConsequent(): float
    {
        return $this->consequent;
    }

    public function format(): string
    {
        return sprintf('%.2f : %.2f', $this->antecedent, $this->consequent);
    }
}
