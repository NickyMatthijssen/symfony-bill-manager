<?php

declare(strict_types=1);

namespace App\Presentation\Mapper\BreadcrumbMapper;

use App\Presentation\Data\Breadcrumb;

final class AddBillBreadcrumbMapper implements BreadcrumbMapperInterface
{
    public function supports(string $route): bool
    {
        return $route === 'dashboard.bills.add';
    }

    public function map(): array
    {
        return [
            new Breadcrumb('Dashboard', 'dashboard'),
            new Breadcrumb('Add bill', 'dashboard'),
        ];
    }
}
