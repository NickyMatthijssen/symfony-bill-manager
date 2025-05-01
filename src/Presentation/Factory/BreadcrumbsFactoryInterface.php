<?php

declare(strict_types=1);

namespace App\Presentation\Factory;

use App\Presentation\Mapper\BreadcrumbMapper\BreadcrumbMapperInterface;

interface BreadcrumbsFactoryInterface
{
    public function getMapper(string $route): ?BreadcrumbMapperInterface;
}
