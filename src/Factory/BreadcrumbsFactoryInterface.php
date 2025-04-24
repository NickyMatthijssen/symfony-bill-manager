<?php

declare(strict_types=1);

namespace App\Factory;

use App\Mapper\BreadcrumbMapper\BreadcrumbMapperInterface;

interface BreadcrumbsFactoryInterface
{
    public function getMapper(string $route): ?BreadcrumbMapperInterface;
}
