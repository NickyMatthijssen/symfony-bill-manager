<?php

declare(strict_types=1);

namespace App\Data;

final class Breadcrumb
{
    public function __construct(
        public string $label {
            get => $this->label;
        },
        public string $url = '' {
            get => $this->url;
        },
    ) {
    }
}
