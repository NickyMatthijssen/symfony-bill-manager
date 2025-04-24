<?php

declare(strict_types=1);

namespace App\Doctrine\Types;

use App\ValueObjects\Url;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use InvalidArgumentException;

final class UrlType extends Type
{
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getStringTypeDeclarationSQL($column);
    }

    public function getName(): string
    {
        return 'url';
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?Url
    {
        if (null === $value) {
            return null;
        }

        if (!is_string($value)) {
            throw new InvalidArgumentException('Value must be of type string');
        }

        return Url::createFromString($value);
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;
        }

        if (!($value instanceof Url)) {
            throw new InvalidArgumentException('Value must be of type Url');
        }

        return $value->value;
    }
}