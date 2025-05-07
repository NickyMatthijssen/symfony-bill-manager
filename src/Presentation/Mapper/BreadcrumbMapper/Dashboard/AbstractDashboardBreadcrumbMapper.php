<?php

declare(strict_types=1);

namespace App\Presentation\Mapper\BreadcrumbMapper\Dashboard;

use App\Presentation\Data\Breadcrumb;
use App\Presentation\Mapper\BreadcrumbMapper\BreadcrumbMapperInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;

abstract class AbstractDashboardBreadcrumbMapper implements BreadcrumbMapperInterface
{
    public function __construct(
        protected RouterInterface $router,
    ) {
    }

    public function map(Request $request): array
    {
        return array_merge([
            new Breadcrumb(
                'dashboard.title',
                $this->router->generate('dashboard'),
            ),
        ], $this->getBreadcrumbs($request));
    }

    /**
     * @return list<Breadcrumb>
     */
    abstract protected function getBreadcrumbs(Request $request): array;
}
