<?php

declare(strict_types=1);

namespace App\Presentation\Form\Handler\Transaction;

use App\Application\Cqrs\CommandBusInterface;
use App\Application\Transaction\Command\DeleteTransaction\DeleteTransactionCommand;
use App\Domain\Exception\UnexpectedValueException;
use App\Presentation\Form\Model\Transaction\DeleteTransaction;

final readonly class DeleteTransactionHandler
{
    public function __construct(private CommandBusInterface $commandBus)
    {
    }

    public function handle(DeleteTransaction $data): void
    {
        if (!$data->isConfirmed()) {
            throw new UnexpectedValueException('There should be a confirmation to delete the transaction.');
        }

        $this->commandBus->send(
            new DeleteTransactionCommand($data->getTransactionId()),
        );
    }
}
