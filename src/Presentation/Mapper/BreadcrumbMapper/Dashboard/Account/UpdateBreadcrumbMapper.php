<?php

declare(strict_types=1);

namespace App\Presentation\Mapper\BreadcrumbMapper\Dashboard\Account;

use App\Presentation\Data\Breadcrumb;

final class UpdateBreadcrumbMapper extends AbstractAccountBreadcrumbMapper
{
    public function supports(string $route): bool
    {
        return 'dashboard.account.update' === $route;
    }

    protected function getSubBreadcrumb(): Breadcrumb
    {
        return new Breadcrumb(
            'account.personal_information.update.breadcrumb',
            $this->router->generate('dashboard.account.update'),
        );
    }
}
