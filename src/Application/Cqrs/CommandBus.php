<?php

declare(strict_types=1);

namespace App\Application\Cqrs;

final readonly class CommandBus extends AbstractBus implements CommandBusInterface
{
    public function send(CommandInterface $command): mixed
    {
        return $this->dispatch($command);
    }
}
