<?php

declare(strict_types=1);

namespace App\Presentation\Mapper\BreadcrumbMapper\Dashboard\Account;

use App\Presentation\Data\Breadcrumb;

final class PasswordBreadcrumbMapper extends AbstractAccountBreadcrumbMapper
{
    public function supports(string $route): bool
    {
        return 'dashboard.account.password' === $route;
    }

    protected function getSubBreadcrumb(): Breadcrumb
    {
        return new Breadcrumb(
            'account.security_settings.password.breadcrumb',
            $this->router->generate('dashboard.account.delete'),
        );
    }
}
