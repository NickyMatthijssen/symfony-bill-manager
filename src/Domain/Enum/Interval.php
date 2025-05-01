<?php

declare(strict_types=1);

namespace App\Domain\Enum;

enum Interval: string
{
    case Weekly = 'weekly';
    case Monthly = 'monthly';
    case Yearly = 'yearly';
}
