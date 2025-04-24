<?php

declare(strict_types=1);

namespace App\Service;

use App\ValueObjects\Base64;

interface AvatarGeneratorInterface
{
    public function generate(string $seed): Base64;
}
