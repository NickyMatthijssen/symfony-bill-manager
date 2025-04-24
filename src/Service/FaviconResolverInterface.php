<?php

declare(strict_types=1);

namespace App\Service;

use App\ValueObjects\Url;

interface FaviconResolverInterface
{
    public function resolve(Url $url): ?string;
}
