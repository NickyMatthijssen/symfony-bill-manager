<?php

declare(strict_types=1);

namespace App\Application\Cqrs;

final readonly class QueryBus extends AbstractBus implements QueryBusInterface
{
    public function query(QueryInterface $query): mixed
    {
        return $this->dispatch($query);
    }
}
