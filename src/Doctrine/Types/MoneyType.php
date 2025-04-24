<?php

declare(strict_types=1);

namespace App\Doctrine\Types;

use App\ValueObjects\Money;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use InvalidArgumentException;

final class MoneyType extends Type
{
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getIntegerTypeDeclarationSQL($column);
    }

    public function getName(): string
    {
        return 'money';
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?Money
    {
        if (null === $value) {
            return null;
        }

        if (!is_integer($value)) {
            throw new InvalidArgumentException('value must be an integer or null.');
        }

        return Money::createFromCents($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?int
    {
        if (null === $value) {
            return null;
        }

        if (!($value instanceof Money)) {
            throw new InvalidArgumentException('value should be an instance of Base64');
        }

        return $value->amount;
    }
}
