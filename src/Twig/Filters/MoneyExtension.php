<?php

declare(strict_types=1);

namespace App\Twig\Filters;

use App\ValueObjects\Money;
use Twig\Extension\RuntimeExtensionInterface;

final class MoneyExtension implements RuntimeExtensionInterface
{
    public function format(int|Money $money): string
    {
        if (is_int($money)) {
            return Money::createFromCents($money)->format();
        }

        return $money->format();
    }
}
