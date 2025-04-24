<?php

declare(strict_types=1);

namespace App\Doctrine\Types;

use App\ValueObjects\Base64;
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

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): Base64
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException('value must be a string.');
        }

        [$type, $base64] = explode(':', $value, 2);
        return Base64::createFromBase64($type, $base64);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!($value instanceof Base64)) {
            throw new InvalidArgumentException('value should be an instance of Base64');
        }

        return sprintf('%s:%s', $value->type, $value->content);
    }
}
