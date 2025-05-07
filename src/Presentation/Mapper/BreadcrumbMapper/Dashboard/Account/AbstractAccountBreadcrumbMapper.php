<?php

declare(strict_types=1);

namespace App\Presentation\Mapper\BreadcrumbMapper\Dashboard\Account;

use App\Presentation\Data\Breadcrumb;
use App\Presentation\Mapper\BreadcrumbMapper\Dashboard\AbstractDashboardBreadcrumbMapper;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractAccountBreadcrumbMapper extends AbstractDashboardBreadcrumbMapper
{
    final protected function getBreadcrumbs(Request $request): array
    {
        $breadcrumbs = [
            new Breadcrumb(
                'account.breadcrumb',
                $this->router->generate('dashboard.account'),
            ),
        ];

        $subBreadcrumb = $this->getSubBreadcrumb();
        if (null !== $subBreadcrumb) {
            $breadcrumbs[] = $subBreadcrumb;
        }

        return $breadcrumbs;
    }

    protected function getSubBreadcrumb(): ?Breadcrumb
    {
        return null;
    }
}
