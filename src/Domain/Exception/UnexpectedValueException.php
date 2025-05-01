<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use UnexpectedValueException as SplUnexpectedValueException;

final class UnexpectedValueException extends SplUnexpectedValueException
{
    public static function unexpectedPropertyValue(string $name, mixed $value): self
    {
        return new self(sprintf(
            'property "%s" should not be of type "%s"',
            $name,
            get_debug_type($value),
        ));
    }
}
