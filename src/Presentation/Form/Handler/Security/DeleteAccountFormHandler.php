<?php

declare(strict_types=1);

namespace App\Presentation\Form\Handler\Security;

use App\Application\Cqrs\CommandBusInterface;
use App\Application\Security\DeleteUser\DeleteUserCommand;
use App\Domain\Entity\User;
use App\Presentation\Form\Model\Account\DeleteAccount;
use LogicException;
use Symfony\Bundle\SecurityBundle\Security;
use UnexpectedValueException;

final readonly class DeleteAccountFormHandler
{
    public function __construct(
        private CommandBusInterface $commandBus,
        private Security $security,
    ) {
    }

    public function handle(DeleteAccount $data): void
    {
        if (false === $data->getAgreesToBeDeleted()) {
            throw new UnexpectedValueException('A user needs to agree to be deleted.');
        }

        $user = $this->security->getUser();
        if (!($user instanceof User)) {
            throw new LogicException('There is no signed in user to delete their account.');
        }

        $this->commandBus->send(
            new DeleteUserCommand($user->getUserIdentifier()),
        );
        $this->security->logout(false);
    }
}
