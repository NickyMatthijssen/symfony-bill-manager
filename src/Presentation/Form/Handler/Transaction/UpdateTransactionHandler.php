<?php

declare(strict_types=1);

namespace App\Presentation\Form\Handler\Transaction;

use App\Application\Cqrs\CommandBusInterface;
use App\Application\Transaction\Command\UpdateTransaction\UpdateTransactionCommand;
use App\Domain\Entity\Transaction;
use App\Domain\Exception\UnexpectedValueException;
use App\Presentation\Form\Model\Transaction\UpdateTransaction;

final readonly class UpdateTransactionHandler
{
    public function __construct(private CommandBusInterface $commandBus)
    {
    }

    public function handle(UpdateTransaction $data): void
    {
        $this->commandBus->send(new UpdateTransactionCommand(
            $data->getTransactionId(),
            $data->getName(),
            $data->getAmount(),
            $data->getInterval(),
            $data->getUrl(),
        ));
    }
}
