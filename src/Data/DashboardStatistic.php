<?php

declare(strict_types=1);

namespace App\Data;

use App\ValueObjects\Money;

final class DashboardStatistic
{
    public function __construct(
        public string $title {
        get => $this->title;
        },
        public Money $value {
        get => $this->value;
        },
    ) {
    }
}
