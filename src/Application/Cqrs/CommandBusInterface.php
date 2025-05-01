<?php

declare(strict_types=1);

namespace App\Application\Cqrs;

interface CommandBusInterface
{
    /**
     * @template T
     * @param CommandInterface<T> $command
     * @return T
     */
    public function send(CommandInterface $command): mixed;
}
