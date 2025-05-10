<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use LogicException;

final class EntityNotFoundException extends LogicException
{
    public static function couldNotBeFoundByAttribute(string $class, string $attribute, string|float|int $value): self
    {
        return new self(sprintf(
            'Could not find entity "%s" with attribute "%s" with value "%s"',
            $class,
            $attribute,
            $value,
        ));
    }
}
