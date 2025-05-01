<?php

declare(strict_types=1);

namespace App\Application\Common;

use App\Domain\ValueObject\Base64;

interface AvatarGeneratorInterface
{
    public function generate(string $seed): Base64;
}
