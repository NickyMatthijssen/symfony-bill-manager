<?php

declare(strict_types=1);

namespace App\Application\Cqrs;

use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

abstract readonly class AbstractBus
{
    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    /**
     * @template T
     * @param CommandInterface<T>|QueryInterface<T> $dispatchable
     * @return T
     */
    public function dispatch(CommandInterface|QueryInterface $dispatchable): mixed
    {
        $envelope = $this->messageBus->dispatch($dispatchable);
        $handledStamp = $envelope->last(HandledStamp::class);

        return $handledStamp?->getResult();
    }
}
