<?php

declare(strict_types=1);

namespace App\Presentation\Form\Handler\Security;

use App\Application\Cqrs\CommandBusInterface;
use App\Application\Security\Command\UpdatePassword\UpdatePasswordCommand;
use App\Domain\Entity\User;
use App\Domain\Exception\UnexpectedValueException;
use App\Presentation\Form\Model\Account\UpdatePassword;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final readonly class UpdatePasswordHandler
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private Security $security,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function handle(UpdatePassword $data): void
    {
        $user = $this->security->getUser();
        if (!($user instanceof User)) {
            throw UnexpectedValueException::unexpectedPropertyValue('user', $user);
        }

        if (!$this->passwordHasher->isPasswordValid($user, (string) $data->getCurrentPassword())) {
            throw new UnexpectedValueException('The current password is incorrect.');
        }

        $newPassword = $data->getNewPassword();
        if (null === $newPassword) {
            throw UnexpectedValueException::unexpectedPropertyValue('newPassword', $newPassword);
        }

        $this->commandBus->send(
            new UpdatePasswordCommand($user->getUserIdentifier(), $newPassword),
        );
    }
}
