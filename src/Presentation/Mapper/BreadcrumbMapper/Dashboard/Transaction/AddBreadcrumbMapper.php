<?php

declare(strict_types=1);

namespace App\Presentation\Mapper\BreadcrumbMapper\Dashboard\Transaction;

use App\Presentation\Data\Breadcrumb;
use App\Presentation\Mapper\BreadcrumbMapper\Dashboard\AbstractDashboardBreadcrumbMapper;
use Symfony\Component\HttpFoundation\Request;

final class AddBreadcrumbMapper extends AbstractDashboardBreadcrumbMapper
{
    public function supports(string $route): bool
    {
        return 'dashboard.transaction.add' === $route;
    }

    protected function getBreadcrumbs(Request $request): array
    {
        return [
            new Breadcrumb(
                'dashboard.transaction.add.title',
                $this->router->generate('dashboard.transaction.add'),
            ),
        ];
    }
}
