<?php

declare(strict_types=1);

namespace App\Presentation\Data;

final readonly class PersonalInformation
{
    public function __construct(
        public string $label,
        public string $value,
    ) {
    }
}
