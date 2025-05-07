<?php

declare(strict_types=1);

namespace App\Presentation\Mapper\BreadcrumbMapper;

use App\Presentation\Data\Breadcrumb;
use Symfony\Component\HttpFoundation\Request;

interface BreadcrumbMapperInterface
{
    public function supports(string $route): bool;

    /**
     * @return list<Breadcrumb>
     */
    public function map(Request $request): array;
}
