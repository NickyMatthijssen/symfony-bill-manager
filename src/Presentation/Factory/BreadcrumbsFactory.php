<?php

declare(strict_types=1);

namespace App\Presentation\Factory;

use App\Presentation\Mapper\BreadcrumbMapper\BreadcrumbMapperInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

final readonly class BreadcrumbsFactory implements BreadcrumbsFactoryInterface
{
    /**
     * @param iterable<array-key, BreadcrumbMapperInterface> $mappers
     */
    public function __construct(
        #[AutowireIterator('mapper.breadcrumb')]
        private iterable $mappers,
    ) {
    }

    public function getMapper(string $route): ?BreadcrumbMapperInterface
    {
        return new ArrayCollection(iterator_to_array($this->mappers))->findFirst(static fn (int $key, BreadcrumbMapperInterface $mapper) => $mapper->supports($route));
    }
}
