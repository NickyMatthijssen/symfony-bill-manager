<?php

declare(strict_types=1);

namespace App\Presentation\Form\Handler\Security;

use App\Application\Cqrs\CommandBusInterface;
use App\Application\Security\Command\UpdateUser\UpdateUserCommand;
use App\Presentation\Form\Model\Account\UpdateAccount;

final readonly class UpdateAccountFormHandler
{
    public function __construct(private CommandBusInterface $commandBus)
    {
    }

    public function handle(UpdateAccount $data): void
    {
        $this->commandBus->send(new UpdateUserCommand(
            $data->getUserIdentifier(),
            $data->getEmail(),
            $data->getFirstName(),
            $data->getLastName(),
        ));
    }
}
