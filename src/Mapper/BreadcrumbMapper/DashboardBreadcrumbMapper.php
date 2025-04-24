<?php

declare(strict_types=1);

namespace App\Mapper\BreadcrumbMapper;

use App\Data\Breadcrumb;

class DashboardBreadcrumbMapper implements BreadcrumbMapperInterface
{
    public function supports(string $route): bool
    {
        return $route === 'dashboard';
    }

    public function map(): array
    {
        return [
            new Breadcrumb('dashboard.title', '#'),
        ];
    }
}
