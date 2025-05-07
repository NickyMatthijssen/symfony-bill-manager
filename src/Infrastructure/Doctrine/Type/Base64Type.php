<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Type;

use App\Domain\ValueObject\Base64;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use InvalidArgumentException;

final class Base64Type extends Type
{
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getStringTypeDeclarationSQL($column);
    }

    public function getName(): string
    {
        return 'base64';
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?Base64
    {
        if (null === $value) {
            return null;
        }

        if (!is_string($value)) {
            throw new InvalidArgumentException('value must be a string.');
        }

        [$type, $base64] = explode(':', $value, 2);
        return Base64::createFromBase64($type, $base64);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;
        }

        if (!($value instanceof Base64)) {
            throw new InvalidArgumentException('value should be an instance of Base64');
        }

        return sprintf('%s:%s', $value->getType(), $value->getContent());
    }
}
