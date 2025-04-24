<?php

declare(strict_types=1);

namespace App\Form\Transformer;

use App\Form\Type\Input\MoneyType;
use App\ValueObjects\Money;
use InvalidArgumentException;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * @extends DataTransformerInterface<float|int, Money>
 */
final class MoneyTransformer implements DataTransformerInterface
{
    public function transform(mixed $value): ?float
    {
        if (null === $value) {
            return null;
        }

        if (!($value instanceof Money)) {
            throw new InvalidArgumentException(sprintf(
                'value should be an instance of Money, "%s" given',
                get_debug_type($value),
            ));
        }

        return $value->inEuros();
    }

    public function reverseTransform(mixed $value): ?Money
    {
        if (null === $value) {
            return null;
        }

        if (!is_float($value) && !is_int($value)) {
            throw new InvalidArgumentException(sprintf(
                'value should be type of float or int, "%s" given',
                get_debug_type($value),
            ));
        }

        return Money::createFromEuros($value);
    }
}
