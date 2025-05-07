<?php

declare(strict_types=1);

namespace App\Presentation\Data;

use App\Domain\ValueObject\StatisticInterface;
use App\Presentation\Enum\Color;

final readonly class DashboardStatistic
{
    public function __construct(
        public string $title,
        public StatisticInterface $value,
        public Color $color = Color::White,
    ) {
    }
}
