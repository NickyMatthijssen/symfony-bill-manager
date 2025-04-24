<?php

declare(strict_types=1);

namespace App\Mapper\BreadcrumbMapper;

use App\Data\Breadcrumb;

interface BreadcrumbMapperInterface
{
    public function supports(string $route): bool;

    /**
     * @return list<Breadcrumb>
     */
    public function map(): array;
}
