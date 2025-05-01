<?php

declare(strict_types=1);

namespace App\Presentation\Form\Transformer;

use App\Domain\ValueObject\Money;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * @implements  DataTransformerInterface<Money, float|int>
 */
final class MoneyTransformer implements DataTransformerInterface
{
    public function transform(mixed $value): ?float
    {
        if (null === $value) {
            return null;
        }

        return $value->inEuros();
    }

    public function reverseTransform(mixed $value): ?Money
    {
        if (null === $value) {
            return null;
        }

        return Money::createFromEuros($value);
    }
}
