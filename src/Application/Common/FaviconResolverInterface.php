<?php

declare(strict_types=1);

namespace App\Application\Common;

use App\Domain\ValueObject\Url;

interface FaviconResolverInterface
{
    public function resolve(Url $url): ?string;
}
