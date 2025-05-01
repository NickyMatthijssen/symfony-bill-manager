<?php

declare(strict_types=1);

namespace App\Application\Cqrs;

interface QueryBusInterface
{
    /**
     * @template T
     * @param QueryInterface<T> $query
     * @return T
     */
    public function query(QueryInterface $query);
}
