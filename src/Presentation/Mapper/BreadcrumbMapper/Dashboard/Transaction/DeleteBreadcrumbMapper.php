<?php

declare(strict_types=1);

namespace App\Presentation\Mapper\BreadcrumbMapper\Dashboard\Transaction;

use App\Presentation\Data\Breadcrumb;
use App\Presentation\Mapper\BreadcrumbMapper\Dashboard\AbstractDashboardBreadcrumbMapper;
use Symfony\Component\HttpFoundation\Request;

final class DeleteBreadcrumbMapper extends AbstractDashboardBreadcrumbMapper
{
    public function supports(string $route): bool
    {
        return 'dashboard.transaction.delete' === $route;
    }

    protected function getBreadcrumbs(Request $request): array
    {
        return [
            new Breadcrumb(
                'dashboard.transaction.delete.breadcrumb',
                $this->router->generate('dashboard.transaction.delete', ['id' => $request->get('id')]),
            ),
        ];
    }
}
