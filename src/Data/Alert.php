<?php

declare(strict_types=1);

namespace App\Data;

use App\Enum\AlertType;

final readonly class Alert
{
    public function __construct(
        public AlertType $type,
        public string $title,
        public ?string $message,
    ) {
    }
}
