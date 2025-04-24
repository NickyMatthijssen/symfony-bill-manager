<?php

declare(strict_types=1);

namespace App\Data;

final class PersonalInformation
{
    public function __construct(
        public string $label {
        get => $this->label;
        },
        public string $value {
        get => $this->value;
        },
    ) {
    }
}
