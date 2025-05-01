<?php

declare(strict_types=1);

namespace App\Presentation\Data;

use App\Presentation\Enum\AlertType;

final readonly class Alert
{
    public function __construct(
        public AlertType $type,
        public string $title,
        public ?string $message,
    ) {
    }
}
