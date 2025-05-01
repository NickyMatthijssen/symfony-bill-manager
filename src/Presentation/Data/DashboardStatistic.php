<?php

declare(strict_types=1);

namespace App\Presentation\Data;

use App\Domain\ValueObject\Money;

final readonly class DashboardStatistic
{
    public function __construct(
        public string $title,
        public Money $value,
    ) {
    }
}
