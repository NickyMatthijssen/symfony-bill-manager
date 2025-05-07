<?php

declare(strict_types=1);

namespace App\Presentation\Twig;

use App\Presentation\Factory\BreadcrumbsFactoryInterface;
use App\Presentation\Twig\Filters\MoneyExtension;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFilter;

final class AppExtension extends AbstractExtension implements GlobalsInterface
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly BreadcrumbsFactoryInterface $breadcrumbMapperFactory,
    ) {
    }

    /**
     * @return list<TwigFilter>
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('money', [MoneyExtension::class, 'format']),
        ];
    }

    /**
     * @return array<array-key, mixed>
     */
    public function getGlobals(): array
    {
        $request = $this->requestStack->getCurrentRequest();
        assert($request instanceof Request);
        $route = $request->get('_route');
        assert(is_string($route));

        return [
            'breadcrumbs' => $this->breadcrumbMapperFactory->getMapper($route)?->map($request),
        ];
    }
}
