<?php

declare(strict_types=1);

namespace App\Presentation\Mapper\BreadcrumbMapper\Dashboard;

use App\Presentation\Mapper\BreadcrumbMapper\Dashboard\Account\AbstractAccountBreadcrumbMapper;

final class AccountBreadcrumbMapper extends AbstractAccountBreadcrumbMapper
{
    public function supports(string $route): bool
    {
        return 'dashboard.account' === $route;
    }
}
