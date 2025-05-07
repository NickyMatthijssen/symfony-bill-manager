<?php

declare(strict_types=1);

namespace App\Presentation\Mapper\BreadcrumbMapper\Dashboard\Account;

use App\Presentation\Data\Breadcrumb;

final class DeleteBreadcrumbMapper extends AbstractAccountBreadcrumbMapper
{
    public function supports(string $route): bool
    {
        return 'dashboard.account.delete' === $route;
    }

    protected function getSubBreadcrumb(): Breadcrumb
    {
        return new Breadcrumb(
            'account.delete.breadcrumb',
            $this->router->generate('dashboard.account.delete'),
        );
    }
}
