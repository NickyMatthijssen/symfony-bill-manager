<?php

declare(strict_types=1);

namespace App\Presentation\Twig\Filters;

use App\Domain\ValueObject\Money;
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
